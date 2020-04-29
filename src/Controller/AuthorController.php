<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Publisher;
use App\Repository\AuthorRepository;
use App\Repository\PublisherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthorController
 * @package App\Controller
 * @Route("/author")
 */

class AuthorController extends AbstractController
{
    /**
     * @Route("/", name="author-list")
     */
    public function index(AuthorRepository $repository)
    {
        $authorsWithBooks = $repository->getAllAuthorsWithBooks();
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
            'authorsWithBooks'=> $authorsWithBooks->getResult()
        ]);
    }

    /**
     * @Route("/{id}", name="author-details", requirements={"id":"\d+"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showOne(AuthorRepository $repository, Author $author){
        $authorsPublisher = $repository->getPublishersByAuthor($author);
        return $this->render('author/show-one.html.twig', [
            'author'    => $author,
            'authorPublishers'=> $authorsPublisher->getResult()

        ]);
    }


}
