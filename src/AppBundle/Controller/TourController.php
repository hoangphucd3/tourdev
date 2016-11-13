<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use AppBundle\Form\CommentType;
use AppBundle\Form\TourOrderType;
use AppBundle\Form\TourSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TourController extends Controller
{
    /**
     * @Route("/tour/{slug}/", name="tour_detail")
     * @Method("GET")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"slug": "slug"}})
     */
    public function tourShowAction(Tour $tour)
    {
//        $comments = $this->getDoctrine()->getRepository('AppBundle:TourOrder');
//        dump($comments);
        return $this->render('single-tour/content.html.twig', ['tour' => $tour]);
    }

    /**
     * @Route("/order/{id}", name="tour_order_show")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"id": "id"}})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function orderShowAction(Request $request, Tour $tour)
    {
        $departure = $this->get('session')->get('departure');
        $adults = $this->get('session')->get('adults');
        $children = $this->get('session')->get('children');
        $infants = $this->get('session')->get('infants');

        if (empty($departure) && empty($tour_id) && (empty($adults) && empty($children) && empty($infants))) {
            return $this->redirectToRoute('tour_index');
        }

        $template_args = array(
            'tour' => $tour,
            'adults' => $adults,
            'children' => $children,
            'infants' => $infants,
            'departure' => $departure,
        );

        return $this->render(':checkout:content.html.twig', $template_args);
    }


    /**
     * @Route("/booking/{tourSlug}/new", name="tour_booking_new")
     * @Method("POST")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"tourSlug": "slug"}})
     *
     * @param Request $request
     * @param Tour $tour
     * @return Response
     */
    public function bookingNewAction(Request $request, Tour $tour)
    {
        $form = $this->getBookingForm($tour);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking_data = $form->getData();

            $this->get('session')->set('departure', $booking_data['departure']);
            $this->get('session')->set('adults', $booking_data['adults']);
            $this->get('session')->set('children', $booking_data['children']);
            $this->get('session')->set('infants', $booking_data['infants']);

            return $this->redirectToRoute('tour_order_show', ['id' => $tour->getId()]);
        }
    }

    /**
     * @Route("/order/{tour}/new", name="tour_order_new")
     * @Method("POST")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("tour", options={"mapping": {"tour": "id"}})
     */
    public function orderNewAction(Request $request, Tour $tour)
    {
        $form = $this->createForm(TourOrderType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $departure = \DateTime::createFromFormat("d/m/Y", $this->get('session')->get('departure'));

            $order->setTour($tour);
            $order->setCustomer($this->get('app.user_manager')->getCurrentUser());
            $order->setDeparture($departure);
            $order->setStatus('pending');

            if ($this->get('app.tour_order_manager')->createTourOrder($order)) {
                $this->get('session')->remove('departure');
                $this->get('session')->remove('adults');
                $this->get('session')->remove('children');
                $this->get('session')->remove('infants');

                return $this->redirectToRoute('tour_detail', ['slug' => $tour->getSlug()]);
            } else {
                return new Response('Có vấn đề khi tạo hóa đơn?');
            }
        }
    }

    /**
     * @Route("/comment/{tour_id}/new", name="tour_comment_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("tour", options={"mapping": {"tour_id": "id"}})
     *
     * @param Request $request
     * @param Tour $tour
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
                return $this->redirectToRoute('tour_detail', ['slug' => $tour->getSlug()]);
            } else {
                return new Response('Có vấn đề khi tạo bình luận?');
            }
        }
    }

    /**
     * @Route("/tour-listing", name="tour_listing")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function tourSearchAction(Request $request)
    {
        $form = $this->createForm(TourSearchType::class);

        $form->handleRequest($request);

        $tours = $this->get('app.tour_manager')->getAllTours();

        if ($form->isSubmitted() && $form->isValid()) {
            $search_data = $form->getData();

            $repositoryManager = $this->container->get('fos_elastica.manager');
            $repository = $repositoryManager->getRepository('AppBundle:Tour');

            $tours = $repository->findTours($search_data);
        }

        return $this->render('archive/tour-listing.html.twig', ['tours' => $tours]);
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function bookingFormAction(Tour $tour)
    {
        $form = $this->getBookingForm($tour);

        return $this->render('single-tour/_booking_form.html.twig', [
            'tour' => $tour,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function orderFormAction(Tour $tour)
    {
        $form = $this->createForm(TourOrderType::class);

        return $this->render(':checkout:_order_form.html.twig', array(
            'tour' => $tour,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function commentFormAction(Tour $tour)
    {
        $form = $this->createForm(CommentType::class);

        return $this->render(':single-tour:_comment_form.html.twig', array(
            'tour' => $tour,
            'form' => $form->createView(),
        ));
    }

    public function tourSearchFormAction()
    {
        $form = $this->createForm(TourSearchType::class);

        return $this->render(':search:_tour_seach_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getBookingForm(Tour $tour)
    {
        $tourAmount = $tour->getAmount();

        $amount = array('0' => 0);

        for ($i = 1; $i < $tourAmount; $i++) {
            $amount[$i] = $i;
        }

        $form = $this->createFormBuilder(array())
            ->add('departure', TextType::class, array(
                'label' => 'Chọn ngày khởi hành',
                'attr' => ['placeholder' => 'Ngày khởi hành']
            ))
            ->add('adults', ChoiceType::class, array(
                'label' => 'Người lớn',
                'choices' => $amount,
            ))
            ->add('children', ChoiceType::class, array(
                'label' => 'Trẻ nhỏ',
                'choices' => $amount,
            ))
            ->add('infants', ChoiceType::class, array(
                'label' => 'Em bé',
                'choices' => $amount,
            ))
            ->getForm();

        return $form;
    }
}
