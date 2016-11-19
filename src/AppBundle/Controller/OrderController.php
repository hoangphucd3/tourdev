<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Entity\Invoice;
use AppBundle\Entity\Tour;
use AppBundle\Entity\TourOrder;
use AppBundle\Form\TourOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class OrderController extends Controller
{
    /**
     * @Route("/order/{id}", name="tour_order_show")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"id": "id"}})
     *
     * @param Request $request
     * @param Tour $tour
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function orderShowAction(Request $request, Tour $tour)
    {
        $adults = $this->get('session')->get('adults');
        $children = $this->get('session')->get('children');
        $infants = $this->get('session')->get('infants');

        if ((empty($adults) && empty($children) && empty($infants))) {
            return $this->redirectToRoute('tour_index');
        }

        $template_args = array(
            'tour' => $tour,
            'adults' => $adults,
            'children' => $children,
            'infants' => $infants,
        );

        return $this->render(':Checkout:content.html.twig', $template_args);
    }

    /**
     * @Route("/order/{tour}/new", name="tour_order_new")
     * @Method("POST")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @ParamConverter("tour", options={"mapping": {"tour": "id"}})
     *
     * @param Request $request
     * @param Tour $tour
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function orderNewAction(Request $request, Tour $tour)
    {
        $form = $this->createForm(TourOrderType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $em = $this->getDoctrine()->getManager();
            $order = $form->getData();
            $customer = $this->getCustomer();

            if (null === $customer) {
                $currentUser = $this->getUser();
                $customer = new Customer();
                $customer->setUser($currentUser);

                $em->persist($customer);
                $em->flush();
            }

            $order->setTour($tour);
            $order->setCustomer($customer);
            $order->setNumberOfAdults($this->get('session')->get('adults'));
            $order->setNumberOfChildren($this->get('session')->get('children'));
            $order->setNumberOfInfants($this->get('session')->get('infants'));
            $order->setStatus('pending');
            $order->setCheckoutMethod($request->request->get('payment_method'));

            $em->persist($order);
            $em->flush();

            $orderId = $order->getId();

//            $tourOrder = $this->get('app.tour_order_manager')->createTourOrder($order);

            if (!empty($tour->getSalePrice())) {
                $price = $tour->getSalePrice();
            } else {
                $price = $tour->getRegularPrice();
            }

            $adultPrice = $this->get('session')->get('adults') * $price;
            $childrenPrice = ($this->get('session')->get('children') * $price) / 1.5;

            $totalPrice = $adultPrice + $childrenPrice;

            $this->get('session')->remove('departure');
            $this->get('session')->remove('adults');
            $this->get('session')->remove('children');
            $this->get('session')->remove('infants');

            $invoice = new Invoice();
            $invoice->setCustomer($customer);
            $invoice->setStatus('pending');
            $invoice->setTourOrder($order);
            $invoice->setTotalPrice($totalPrice);

            $em->persist($invoice);
            $em->flush();

            if ('onepay' === $request->request->get('payment_method')) {
                return $this->redirectToRoute('onepay_checkout_url', array(
                        'price' => $totalPrice,
                        'orderId' => $orderId,
                    )
                );
            } else {
                $this->get('session')->set('new_order_created', 1);
                return $this->redirectToRoute('tour_order_received', array('id' => $orderId));
            }
        } else {
            return new Response('Có lỗi ?');
        }
    }

    /**
     * @param Tour $tour
     * @return Response
     */
    public function orderFormAction(Tour $tour)
    {
        $form = $this->createForm(TourOrderType::class);

        return $this->render(':Checkout:_order_form.html.twig', array(
            'tour' => $tour,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/order/received/{id}", name="tour_order_received")
     * @ParamConverter("tourOrder", class="AppBundle:TourOrder", options={"mapping" : {"id": "id"}})
     *
     * @param TourOrder $tourOrder
     * @return Response
     */
    public function codCheckoutAction(TourOrder $tourOrder)
    {
        if (empty($this->get('session')->get('new_order_created'))) {
            return $this->redirect('/');
        }

        $this->get('session')->remove('new_order_viewed');

        return $this->render(':Checkout:order_received.html.twig', array('tourOrder' => $tourOrder));
    }

    /**
     * @Route("/order/received/{id}/complete", name="tour_order_checkout_onepay_complete")
     * @ParamConverter("tourOrder", class="AppBundle:TourOrder", options={"mapping" : {"id": "id"}})
     *
     * @param TourOrder $tourOrder
     * @return Response
     */
    public function onePayCheckoutAction(TourOrder $tourOrder)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:TourOrder')->find($tourOrder->getId());

        $order->setStatus('completed');
        $em->flush();

        return $this->render(':Checkout:order_received.html.twig', array('tourOrder' => $tourOrder));
    }

    protected function getCustomer()
    {
        $user = $this->getUser();

        $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->findOneBy(array('user' => $user));

        return $customer;
    }
}
