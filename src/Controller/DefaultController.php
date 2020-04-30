<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/login-user", name="user_login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminLogin(AuthenticationUtils $authenticationUtils, Request $request){

        if($request->get("_route") == "user_login"){
            $formTitle = "user";
            $formAction = "user_login_check";
        }else{
            $formTitle = "admin";
            $formAction = "admin_login_check";
        }
        return $this->render("login.html.twig", [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'userName'=> $authenticationUtils->getLastUsername(),
            'title'   => $formTitle,
            'action'  => $formAction

        ]);
    }
}
