<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use AppBundle\Search\TourSearch;
use Elastica\Query;
use Elastica\Suggest;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\TourAdvancedSearchType;
use AppBundle\Form\TourSearchType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SearchController extends Controller
{
    /**
     * @Route("/tour-listing", defaults={"page" : 1}, name="tour_listing")
     * @Route("/tour-listing/{page}", requirements={"page": "[1-9]\d*"}, name="tour_listing_paginated")
     *
     * @param Request $request
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourListingAction(Request $request, $page)
    {
        $tours = $this->getDoctrine()->getRepository('AppBundle:Tour')->findLastest($page);

        return $this->render(':Archive:tour-listing.html.twig', ['tours' => $tours]);
    }

    /**
     * @Route("/tour-listing/filters/advanced", defaults={"page" : 1}, name="tour_listing_advanced_filters")
     * @Route("/tour-listing/fitlers/advanced/{page}", requirements={"page": "[1-9]\d*"}, name="tour_listing_advanced_filters_paginated")
     *
     * @param Request $request
     * @return Response
     */
    public function tourAdvancedSearchAction(Request $request, $page)
    {
        $search_data = new TourSearch();

        $form = $this->createForm(TourAdvancedSearchType::class, $search_data, array(
            'session' => $this->get('session'),
        ));

        $form->handleRequest($request);

        $search_data = $form->getData();

        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('AppBundle:Tour');

        $tours = $repository->advancedSearchTour($search_data);

        $adapter = new ArrayAdapter($tours);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page);

        return $this->render(':Archive:tour-listing-advanced-filters.html.twig', array(
            'tours' => $pager->getCurrentPageResults(),
            'pager' => $pager
        ));
    }

    /**
     * @Route("/tour-listing/fitlers/", defaults={"page" : 1}, name="tour_listing_filters")
     * @Route("/tour-listing/fitlers/{page}", requirements={"page": "[1-9]\d*"}, name="tour_listing_filters_paginated")
     *
     * @param Request $request
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tourSearchAction(Request $request, $page)
    {
        $search_data = new TourSearch();

        $form = $this->createForm(TourSearchType::class, $search_data);

        $form->handleRequest($request);

        $search_data = $form->getData();

        $this->get('session')->set('search_tourName', $search_data->getTourName());
        $this->get('session')->set('search_locations', $search_data->getLocations());
        $this->get('session')->set('search_departure', $search_data->getDeparture());

        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('AppBundle:Tour');

        $tours = $repository->searchTour($search_data);

        $adapter = new ArrayAdapter($tours);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page);

        return $this->render(':Archive:tour-listing-filters.html.twig', array(
            'tours' => $pager->getCurrentPageResults(),
            'pager' => $pager
        ));
    }

    /**
     * @Route("/tour-suggest", name="tour_suggest")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function autoCompleteTourNameAction(Request $request)
    {
        if (!($text = $request->get('q'))) {
            throw new BadRequestHttpException('Missing "q" parameter.');
        }

        $completion = new Suggest\Completion('name_suggest', 'tourName');
        $completion->setText($text);
        $resultSet = $this->get('fos_elastica.index.app.tour')->search(Query::create($completion));

        $suggestions = array();
        foreach ($resultSet->getSuggests() as $suggests) {
            foreach ($suggests as $suggest) {
                foreach ($suggest['options'] as $option) {
                    $suggestions[] = array(
                        'text' => $option['text'],
                    );
                }
            }
        }

        return new JsonResponse(array(
            'suggestions' => $suggestions,
        ));
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
