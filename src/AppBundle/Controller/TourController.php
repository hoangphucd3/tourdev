<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use AppBundle\Form\TourOrderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
        return $this->render('single-tour/content.html.twig', ['tour' => $tour]);
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
        $form = $this->getBookingForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking_data = $form->getData();

            $this->get('session')->set('departure', $booking_data['departure']);
            $this->get('session')->set('adults', $booking_data['adults']);

            return $this->redirectToRoute('tour_order_show', ['id' => $tour->getId()]);
        }
    }

    /**
     * @Route("/order/{id}", name="tour_order_show")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"id": "id"}})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function orderShow(Tour $tour)
    {
        $departure = $this->get('session')->get('departure', null);
        $adults = $this->get('session')->get('adults', null);

        if (empty($departure) && empty($adults) && empty($tour_id)) {
            return $this->redirectToRoute('tour_index');
        }

        return $this->render(':checkout:content.html.twig', ['tour' => $tour]);
    }

    /**
     * @Route("/order/{tour}/new", name="tour_order_new")
     * @Method("POST")
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
                return $this->redirectToRoute('tour_detail', ['slug' => $tour->getSlug()]);
            } else {
                return new Response('Có vấn đề khi tạo hóa đơn?');
            }
        }
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function bookingFormAction(Tour $tour)
    {
        $form = $this->getBookingForm();

        return $this->render('single-tour/_booking_form.html.twig', [
            'tour' => $tour,
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getBookingForm()
    {
        $form = $this->createFormBuilder(array())
            ->add('departure', TextType::class, array(
                'label' => 'Chọn ngày khởi hành',
                'attr' => ['placeholder' => 'Ngày khởi hành']
            ))
            ->add('adults', IntegerType::class, array(
                'label' => 'Số lượng người',
                'attr' => ['min' => 1],
            ))
            ->getForm();

        return $form;
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
}
