<?php

namespace App\Controller\home;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Type\ServiceType;
use App\Entity\Service;
use App\Entity\Image;

/**
 * @Route("/")
 */

class HomeController extends AbstractController{

        /**
         * @Route("/", name="index")
         */
        public function index(){

                $em = $this->getDoctrine()->getManager();

                $serviceRepository = $em->getRepository('App\Entity\Service');
                $services = $serviceRepository->findAll();

                $publicationRepository = $em->getRepository('App\Entity\Publication');
                $publications = $publicationRepository->findBy(
                        ['type' => 'publication']
                );

                $events = $publicationRepository->findBy(
                        ['type' => 'event']
                );
                
                return $this->render('home/index.html.twig', [
                        'services' => $services,
                        'publications' => $publications,
                        'events' => $events
                ]);

        }

}