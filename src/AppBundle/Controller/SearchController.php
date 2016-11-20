<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\TourAdvancedSearchType;
use AppBundle\Form\TourSearchType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{

    /**
     * @Route("/tour-listing", name="tour_listing")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function tourSearchAction(Request $request)
    {
        $form = $this->createForm(TourSearchType::class);

        $form->handleRequest($request);

        $tours = $this->get('app.tour_manager')->getAllTours();

        if ($form->isSubmitted() && $form->isValid()) {
            $search_data = $form->getData();

            $this->get('session')->set('search_tourName', $search_data->getTourName());
            $this->get('session')->set('search_locations', $search_data->getLocations());
            $this->get('session')->set('search_departure', $search_data->getDeparture());

            $repositoryManager = $this->container->get('fos_elastica.manager');
            $repository = $repositoryManager->getRepository('AppBundle:Tour');

            $tours = $repository->findTours($search_data);
        }

        return $this->render(':Archive:tour-listing.html.twig', ['tours' => $tours]);
    }

    /**
     * @Route("/tour-listing/filters", name="tour_listing_filters")
     *
     * @param Request $request
     * @return Response
     */
    public function tourAdvancedSearchAction(Request $request)
    {
        $form = $this->createForm(TourAdvancedSearchType::class, null, array(
            'session' => $this->get('session'),
        ));

        $form->handleRequest($request);

        $tours = $this->get('app.tour_manager')->getAllTours();

        if ($form->isSubmitted() && $form->isValid()) {
            $search_data = $form->getData();

            $repositoryManager = $this->container->get('fos_elastica.manager');
            $repository = $repositoryManager->getRepository('AppBundle:Tour');

            $tours = $repository->advancedFindTours($search_data);
        }

        return $this->render(':Archive:tour-listing.html.twig', ['tours' => $tours, 'request' => $request]);
    }

    /**
     * @return Response
     */
    public function tourSearchFormAction()
    {
        $form = $this->createForm(TourSearchType::class);

        return $this->render(':Search:_tour_seach_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return Response
     */
    public function tourAdvancedSearchFormAction(Request $request)
    {
        $form = $this->createForm(TourAdvancedSearchType::class, null, array(
            'session' => $this->get('session'),
        ));

        return $this->render(':Search:_advanced_search_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
