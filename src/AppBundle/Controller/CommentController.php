<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @Route("/comment/{tourId}/new", name="tour_comment_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("tour", options={"mapping": {"tourId": "id"}})
     *
     * @param Request $request
     * @param Tour $tour
     * @return Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function commentNewAction(Request $request, Tour $tour)
    {
        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $comment->setUser($this->getUser());
            $comment->setTour($tour);

            if ($this->get('app.comment_manager')->createComment($comment)) {
                return $this->redirectToRoute('tour_detail', array(
                        'categorySlug' => $tour->getCategory()->getSlug(),
                        'slug' => $tour->getSlug()
                    )
                );
            } else {
                return new Response('Có vấn đề khi tạo bình luận ?');
            }
        }
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function commentFormAction(Tour $tour)
    {
        $form = $this->createForm(CommentType::class);

        return $this->render(':SingleTour:_comment_form.html.twig', array(
            'tour' => $tour,
            'form' => $form->createView(),
        ));
    }
}
