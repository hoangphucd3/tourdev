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
    public function checkRemainSeatsAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $return = array();
            $form_data = $request->get('form');

            $adults = $form_data['adults'];
            $children = $form_data['children'];
            $infants = $form_data['infants'];
            $tourId = $request->get('tourId');

            $totalNum = abs(intval($adults + $children + $infants));

            $tourInfo = $this->getDoctrine()->getRepository('AppBundle:Tour')->find($tourId);

            $remainSeats = abs(intval($tourInfo->getNumberOfPeople() - count($tourInfo->getTourOrders())));

            if ($totalNum < $remainSeats) {
                $return['status'] = 'success';
            } else {
                $return['status'] = 'error';
                $return['info'] = 'Tour này chỉ còn ' . $remainSeats . ' chỗ ';
            }

            return new JsonResponse($return);
        }

        return new Response('Có lỗi?');
    }
}
