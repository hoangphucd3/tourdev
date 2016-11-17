<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReportController extends Controller
{
    /**
     * @Route("/admin/report/revenue", name="admin_revenue_report")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function revenueReport()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $current_date = new \DateTime();
        $graph_data = array();

        for ($month = 1; $month <= 12; $month++) {
            $revenue = 0;
            $monthHasOrder = $em->createQuery(
                "SELECT to
                FROM AppBundle:TourOrder to
                WHERE DATE_FORMAT(to.createdAt, '%m-%Y') = :month
                "
            )->setParameter('month', $month . '-' . $current_date->format('Y'))->getResult();

            if ($monthHasOrder) {
                foreach ($monthHasOrder as $order) {
                    $tour_price = $order->getTour()->getSalePrice();
                    $adults = $order->getAdults();
                    $children = $order->getChildren();
                    $infants = $order->getInfants();

                    $revenue = (($adults + $children + $infants) * $tour_price);
                }
            }

            $graph_data[] = array('Th' . $month, $revenue);
        }

        $graph_data = $this->get('jms_serializer')->serialize($graph_data, 'json');

        return $this->render('Admin/revenue_report.html.twig', array(
            'graph_data' => $graph_data,
        ));
    }

    /**
     * @Route("/admin/report/tour/", name="admin_tour_report")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourReportShowAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $tours = $em->getRepository('AppBundle:Tour')->findAll();

        return $this->render('Admin/tour_report.html.twig', [
            'tours' => $tours,
        ]);
    }

    /**
     * @Route("/admin/report/tour/{id}", name="admin_tour_detail_report")
     *
     * @param Tour $tour
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourReportDetailAction(Tour $tour)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $tourRepository = $em->getRepository('AppBundle:Tour');
        $orders = $tourRepository->find($tour->getId())->getTourOrders();
        $graph_data = array();

        for ($month = 1; $month <= 12; $month++) {
            $revenue = 0;
            $current_month = \DateTime::createFromFormat('m', $month)->format('m');

            foreach ($orders as $key => $order) {
                $order_date = $order->getcreatedAt();
                if ($order_date->format('m') === $current_month) {
                    $tour_price = $order->getTour()->getSalePrice();
                    $adults = $order->getAdults();
                    $children = $order->getChildren();
                    $infants = $order->getInfants();

                    $revenue = (($adults + $children + $infants) * $tour_price);

                    unset($orders[$key]);
                } else {
                    continue;
                }
            }

            $graph_data[] = array('Th' . $month, $revenue);
        }

        $graph_data = $this->get('jms_serializer')->serialize($graph_data, 'json');

        return $this->render('Admin/revenue_report.html.twig', array(
            'graph_data' => $graph_data,
        ));
    }
}
