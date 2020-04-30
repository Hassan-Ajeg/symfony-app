<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/login-admin", name="admin_login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminLogin(AuthenticationUtils $authenticationUtils){
        return $this->render("login.html.twig", [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'userName'=> $authenticationUtils->getLastUsername()

        ]);
    }
}
