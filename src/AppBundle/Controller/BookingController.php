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
            $bookingData = $form->getData();

            $this->setBookingData($bookingData);

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

        return $this->render('single_tour/_booking_form.html.twig', [
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
        $guessAllowed = $tour->getNumberOfPeople();

        $count = array('0' => 0);

        for ($i = 1; $i <= $guessAllowed; $i++) {
            $count[$i] = $i;
        }

        $form = $this->createFormBuilder(array())
            ->add('adults', ChoiceType::class, array(
                'label' => 'label.adults',
                'choices' => $count,
            ))
            ->add('children', ChoiceType::class, array(
                'label' => 'label.children',
                'choices' => $count,
            ))
            ->add('infants', ChoiceType::class, array(
                'label' => 'label.infants',
                'choices' => $count,
            ))
            ->getForm();

        return $form;
    }

    /**
     * @param $data
     */
    private function setBookingData($data)
    {
        $this->get('session')->set('adults', $data['adults']);
        $this->get('session')->set('children', $data['children']);
        $this->get('session')->set('infants', $data['infants']);
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
            $form_data = $request->get('form');
            $tourId = $request->get('tourId');
            $result = $this->getBookingResult($form_data, $tourId);

            return new JsonResponse($result);
        }

        return new Response('Có lỗi?');
    }

    /**
     * @param $data
     * @param $tourId
     * @return array
     */
    private function getBookingResult($data, $tourId)
    {
        $numberOfGuess = $this->getNumberOfGuess($data);

        $tour = $this->getDoctrine()->getRepository('AppBundle:Tour')->find($tourId);
        $departure = $tour->getStartDate();
        $departure->modify('-24 hours');

        $currentTime = new \DateTime();
        $remainSeats = $this->getDoctrine()->getRepository('AppBundle:Tour')->getRemainSeats($tour);

        $return = array();
        $return['status'] = 'error';
        $info = '';
        $translator = $this->get('translator');

        if ($currentTime >= $departure) {
            $info = $translator->trans('error.expired_tour');
        } elseif (0 == $remainSeats) {
            $info = $translator->trans('error.full_tour');
        } elseif (0 == $numberOfGuess) {
            $info = $translator->trans('error.select_number_of_people');
        } elseif ($numberOfGuess > $remainSeats) {
            $info = $translator->trans('There were %number% left', array(
                '%number%' => $remainSeats,
            ));
        } else {
            $return['status'] = 'success';
        }

        $return['info'] = $info;

        return $return;
    }

    /**
     * @param $data
     * @return number
     */
    private function getNumberOfGuess($data)
    {
        $adults = $data['adults'];
        $children = $data['children'];
        $infants = $data['infants'];

        $numberOfGuess = abs(intval($adults + $children + $infants));

        return $numberOfGuess;
    }
}
