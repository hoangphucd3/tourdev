<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//        $user = new \AppBundle\Entity\User();
//        $password = '12345';
//        $encoder = $this->get('security.password_encoder');
//        $encoded = $encoder->encodePassword($user, $password);
//
////        return new Response($encoded);
//
////        $doctrine = $this->getDoctrine()->getManager();
////        $user = $doctrine->getRepository('AppBundle:User')->find(1);
////        $user->setRoles('ROLE_SUPER_ADMIN');
////        $doctrine->flush();
////        return new Response($doctrine->getRepository('AppBundle:User')->findAll());
//        return new Response(dump($this->get('app.user_service')->findUsers()));
//        // replace this example code with whatever you need
////        return $this->render('default/index.html.twig', [
////            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
////        ]);
//    }
}
