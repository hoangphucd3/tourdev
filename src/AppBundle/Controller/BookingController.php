<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BookingController extends Controller
{
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

            $this->get('session')->set('adults', $booking_data['adults']);
            $this->get('session')->set('children', $booking_data['children']);
            $this->get('session')->set('infants', $booking_data['infants']);

            return $this->redirectToRoute('tour_order_show', ['id' => $tour->getId()]);
        }
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function bookingFormAction(Tour $tour)
    {
        $form = $this->getBookingForm($tour);

        return $this->render(':SingleTour:_booking_form.html.twig', [
            'tour' => $tour,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Tour $tour
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getBookingForm(Tour $tour)
    {
        $tourAmount = $tour->getNumberOfPeople();

        $amount = array('0' => 0);

        for ($i = 1; $i <= $tourAmount; $i++) {
            $amount[$i] = $i;
        }

        $form = $this->createFormBuilder(array())
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

    /**
     * @Route("/booking/check", name="tour_booking_check")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function checkTourBookingAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $return = array();
            $form_data = $request->get('form');

            $adults = $form_data['adults'];
            $children = $form_data['children'];
            $infants = $form_data['infants'];
            $tourId = $request->get('tourId');

            $tour = $this->getDoctrine()->getRepository('AppBundle:Tour')->find($tourId);

            $remainSeats = $this->remainSeats($tour);

            $totalNum = abs(intval($adults + $children + $infants));

            $return['status'] = 'error';

            $tourDeparture = $tour->getStartDate();
            $tourDeparture->modify('+24 hours');
            $now = new \DateTime();

            if ($now > $tourDeparture) {
                $return['info'] = 'Tour này đã hết hạn đặt';
            } elseif (0 == $remainSeats) {
                $return['info'] = 'Tour này đã đầy';
            } elseif (0 == $totalNum) {
                $return['info'] = 'Hãy chọn số lượng người';
            } elseif ($totalNum > $remainSeats) {
                $return['info'] = 'Tour này chỉ còn ' . $remainSeats . ' chỗ ';
            } else {
                $return['status'] = 'success';
            }

            return new JsonResponse($return);
        }

        return new Response('Có lỗi?');
    }

    protected function remainSeats(Tour $tour)
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
}
