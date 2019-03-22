<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends  AbstractController{

    #AuthenticationUtils permet d'accéder à plusieur fonction d'authentification
    /**
     * @Route("/login", name="login")
    */
    public function login (AuthenticationUtils $authenticationUtils){

        #recupérer une erreur lors de l'authentification
        $error = $authenticationUtils->getLastAuthenticationError();
        #recupération du dernier utilisateur enregistré
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}