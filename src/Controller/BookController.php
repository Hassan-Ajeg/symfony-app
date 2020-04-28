<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookController
 * @package App\Controller
 * @Route("/book")
 */
class BookController extends AbstractController
{
    /**
     * @Route("-list", name="book-list")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        //liste de tout les livres
        $repository = $this->getDoctrine()->getRepository("App:Book");
        $data = $repository->findAllPaginated();


        $books = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('book/index.html.twig', [
            'bookList' => $books
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new", name="book-new")
     */

    public function showForm(Request $request){
        //création d'une instance de book
        $book = new Book();

        //création de form
        $form = $this->createForm(BookType::class, $book);

        //traitement du formulaire à partir des données de la requête
        //la saisie contenu dans la requête va être injectée dans le formulaire
        $form->handleRequest($request);

        //persistance de l'entité avec Doctrine si le formulaire est soumis
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            //redirection vers la liste des livres
            return $this->redirectToRoute('book-list');
        }

        return $this->render("book/form.html.twig", [
            //envoi du formulaire au modèle Twig
            'bookForm'  => $form->createView()
        ]);
    }
}
