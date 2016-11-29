<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="tour_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tours = $em->getRepository('AppBundle:Tour')->findOpenTours();

        return $this->render('home/index.html.twig', ['tours' => $tours]);
    }
}
