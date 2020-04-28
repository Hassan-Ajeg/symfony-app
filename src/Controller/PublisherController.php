<?php

namespace App\Controller;

use App\Entity\Publisher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PublisherController
 * @package App\Controller
 * @Route("/publisher")
 */

class PublisherController extends AbstractController
{
    /**
     * @Route("/", name="publisher-list")
     */
    public function index()
    {
        return $this->render('publisher/index.html.twig', [
            'controller_name' => 'PublisherController',
        ]);
    }

    /**
     * @Route("/{id}", name="publisher-details", requirements={"id":"\d+"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showOnePublisher(Publisher $publisher){
        return $this->render("publisher/show-one.html.twig", [
            'publisher' => $publisher
        ]);
    }
}
