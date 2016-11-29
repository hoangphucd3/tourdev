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
//        $this->checkTourOrders($tour);

        $remainSeats = $this->checkRemainSeats($tour);

        return $this->render(':SingleTour:content.html.twig', ['tour' => $tour, 'remainSeats' => $remainSeats]);
    }

    /**
     * @param Tour $tour
     * @return int
     */
    protected function checkRemainSeats(Tour $tour)
    {
        $orders = $tour->getTourOrders();

        $count = $tour->getNumberOfPeople();

        foreach ($orders as $order) {
            if ('canceled' !== $order->getStatus()) {
                $people = $order->getNumberOfPeople();
                $count -= $people;

                if ($count < 0) {
                    $count = 0;
                    break;
                }
            }
        }

        return $count;
    }

    /**
     * @param Tour $tour
     * @return bool
     */
    protected function checkTourOrders(Tour $tour)
    {
        $orders = $tour->getTourOrders();
        $em = $this->getDoctrine()->getManager();

        foreach ($orders as $order) {
            $expiryDate = $order->getExpiryDate();
            $now = new \DateTime();

            if ($expiryDate < $now) {
                if ('expired' !== $order->getStatus()) {
                    $order->setStatus('expired');
                    $em->flush();
                }
            }
        }

        return true;
    }
}
