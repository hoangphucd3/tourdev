<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tour;
use AppBundle\Form\AdvancedTourSearchType;
use AppBundle\Form\TourAdvancedSearchType;
use AppBundle\Form\TourSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TourController extends Controller
{
    /**
     * @Route("/{categorySlug}/{slug}.html", name="tour_detail")
     * @Method("GET")
     * @ParamConverter("tour", class="AppBundle:Tour", options={"mapping" : {"slug": "slug"}})
     * @ParamConverter("tourCategory", class="AppBundle:TourCategory", options={"mapping" : {"categorySlug": "slug"}})
     *
     * @param Tour $tour
     * @return Response
     */
    public function tourShowAction(Tour $tour)
    {
        return $this->render(':SingleTour:content.html.twig', ['tour' => $tour]);
    }

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
        $form = $this->createForm(TourAdvancedSearchType::class);

        $form->handleRequest($request);

        dump($form->get('tourName'));

        $tours = $this->get('app.tour_manager')->getAllTours();

        if ($form->isSubmitted() && $form->isValid()) {
            $search_data = $form->getData();

            $repositoryManager = $this->container->get('fos_elastica.manager');
            $repository = $repositoryManager->getRepository('AppBundle:Tour');

            $tours = $repository->advancedFindTours($search_data);
        }

        return $this->render(':Archive:tour-listing.html.twig', ['tours' => $tours]);
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
    public function tourAdvancedSearchFormAction()
    {
        $form = $this->createForm(TourAdvancedSearchType::class);

        return $this->render(':Archive:_advanced_search_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
