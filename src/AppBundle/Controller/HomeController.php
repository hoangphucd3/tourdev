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
        $tours = $this->get('app.tour_manager')->getAllTours();

        return $this->render('home/index.html.twig', ['tours' => $tours]);
    }
}
