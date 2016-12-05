<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class TourController extends Controller
{
    /**
     * @Route("/{categorySlug}/{slug}.html", name="tour_detail")
     * @Method("GET")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"slug": "slug"}})
     * @ParamConverter("tourCategory", class="AppBundle:TourCategory", options={"mapping" : {"categorySlug": "slug"}})
     *
     * @param Tour $tour
     * @return Response
     */
    public function tourShowAction(Tour $tour)
    {
        return $this->render('single_tour/content.html.twig', ['tour' => $tour]);
    }

    public function packageInfoShowAction(Tour $tour)
    {
        $remainSeats = $this->getDoctrine()->getRepository('AppBundle:Tour')->getRemainSeats($tour);

        return $this->render('single_tour/package_info.html.twig', [
            'tour' => $tour,
            'remain_seats' => $remainSeats,
        ]);
    }
}
