<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use AppBundle\Entity\TourCancel;
use AppBundle\Entity\TourOrder;
use AppBundle\Form\TourRequestType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/profile/tour-orders", name="profile_tour_orders")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserOrders()
    {
        $orders = $this->get('app.tour_order_manager')->getUserOrders();

        return $this->render(':Profile:tour_orders.html.twig', ['orders' => $orders]);
    }

    /**
     * @Route("/profile/tour-orders/{tourOrderId}", name="profile_tour_order_detail")
     * @ParamConverter("tourOrder", class="AppBundle:TourOrder", options={"mapping" : {"tourOrderId": "id"}})
     *
     * @param TourOrder $tourOrder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserOrderDetail(TourOrder $tourOrder)
    {
        return $this->render('Profile/tour_order_detail.html.twig', ['orderDetail' => $tourOrder]);
    }

    /**
     * @Route("/profile/{tourOrderId}/edit", name="profile_tour_order_edit")
     * @ParamConverter("tourOrder", class="AppBundle:TourOrder", options={"mapping" : {"tourOrderId": "id"}})
     *
     * @param TourOrder $tourOrder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourRequestShowAction(TourOrder $tourOrder)
    {
        return $this->render('Profile/tour_request.html.twig', ['tourOrder' => $tourOrder]);
    }

    /**
     * @Route("/profile/{tourOrderId}/request/new", name="profile_tour_request_new")
     * @Method("POST")
     * @ParamConverter("tourOrder", class="AppBundle:TourOrder", options={"mapping" : {"tourOrderId": "id"}})
     *
     * @param Request $request
     * @param TourOrder $tourOrder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourRequestNewAction(Request $request, TourOrder $tourOrder)
    {
        $form = $this->createForm(TourRequestType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $request_data = $form->getData();

            $request_data->setTourOrder($tourOrder);
            $request_data->setUser($this->getCustomer());
            $request_data->setStatus('pending');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($request_data);
            $entityManager->flush();

            $this->addFlash('success', 'Yêu cầu của bạn đã được nhận. Chúng tôi sẽ kiểm tra và liên hệ với bạn trong vòng 24 tiếng.');

            return $this->redirectToRoute('profile_tour_order_detail', array('tourOrderId' => $tourOrder->getId()));
        }
    }

    /**
     * @Route("/profile/{tourOrderId}/", name="tour_order_delete")
     * @Method("DELETE")
     * @ParamConverter("tourOrder", class="AppBundle:TourOrder", options={"mapping" : {"tourOrderId": "id"}})
     *
     * @param Request $request
     * @param TourOrder $tourOrder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourOrderDeleteAction(Request $request, TourOrder $tourOrder)
    {
        $form = $this->createTourDeleteForm($tourOrder);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user_order = $entityManager->getRepository('AppBundle:TourOrder')->find($tourOrder->getId());

            $cancelRequest = new TourCancel();
            $cancelRequest->setStatus('pending');
            $cancelRequest->setCustomer($this->getCustomer());
            $cancelRequest->setTourOrder($user_order);

            $entityManager->persist($cancelRequest);
            $entityManager->flush();

            $this->addFlash('success', 'Yêu cầu của bạn đã được nhận. Chúng tôi sẽ kiểm tra và liên hệ với bạn trong vòng 24 tiếng.');

            return $this->redirectToRoute('profile_tour_order_detail', array('tourOrderId' => $tourOrder->getId()));
        }
    }

    /**
     * @param TourOrder $tourOrder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourRequestFormAction(TourOrder $tourOrder)
    {
        $form = $this->createForm(TourRequestType::class);

        return $this->render('Profile/_tour_request_form.html.twig', array(
            'orderDetail' => $tourOrder,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param TourOrder $tourOrder
     * @return Response
     */
    public function tourOrderDeleteFormAction(TourOrder $tourOrder)
    {
        if ($this->isCancelAllow($tourOrder)) {
            $form = $this->createTourDeleteForm($tourOrder);

            return $this->render(':Profile:_tour_order_delete_form.html.twig', [
                'tourOrderId' => $tourOrder->getId(),
                'form' => $form->createView(),
            ]);
        }

        return new Response();
    }

    /**
     * @param TourOrder $tourOrder
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createTourDeleteForm(TourOrder $tourOrder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tour_order_delete', ['tourOrderId' => $tourOrder->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param TourOrder $tourOrder
     * @return Response
     */
    public function createOnePayCheckoutButtonAction(TourOrder $tourOrder)
    {
        if ($this->isOnePayCheckoutAllow($tourOrder)) {
            return $this->render(':Profile/OrderDetail:onepay_checkout_button.html.twig', array('orderDetail' => $tourOrder));
        }

        return new Response();
    }

    /**
     * @param TourOrder $tourOrder
     * @return Response
     */
    public function createRequestButtonAction(TourOrder $tourOrder)
    {
        if ($this->isRequestAllow($tourOrder)) {
            return $this->render(':Profile/OrderDetail:request_button.html.twig', array('orderDetail' => $tourOrder));
        }
        return new Response();
    }

    protected function getCustomer()
    {
        $user = $this->getUser();

        $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->findOneBy(array('user' => $user));

        return $customer;
    }

    /**
     * @param TourOrder $tourOrder
     * @return bool
     */
    private function isOnePayCheckoutAllow(TourOrder $tourOrder)
    {
        $orderStatus = $tourOrder->getStatus();
        $now = new \DateTime();
        $hasCancelRequest = $tourOrder->getCancelRequest();

        if ('pending' == $orderStatus
            && $now < $tourOrder->getExpiryDate()
            && empty($hasCancelRequest)
        ) {
            return true;
        }

        return false;
    }

    private function isRequestAllow(TourOrder $tourOrder)
    {
        $orderStatus = $tourOrder->getStatus();
        $now = new \DateTime();
        $hasRequest = $tourOrder->getRequest();
        $hasCancelRequest = $tourOrder->getCancelRequest();

        if ('pending' == $orderStatus
            && $now < $tourOrder->getExpiryDate()
            && empty($hasRequest)
            && empty($hasCancelRequest)
        ) {
            return true;
        }

        return false;
    }

    private function isCancelAllow(TourOrder $tourOrder)
    {
        $orderStatus = $tourOrder->getStatus();
        $allowDate = $tourOrder->getTour()->getStartDate();
        $allowDate->modify('-24 hours');
        $now = new \DateTime();
        $hasCancelRequest = $tourOrder->getCancelRequest();

        if ('canceled' !== $orderStatus && $now < $allowDate && empty($hasCancelRequest)) {
            return true;
        }

        return false;
    }
}
