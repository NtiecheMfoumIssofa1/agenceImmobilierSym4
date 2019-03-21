<?php

namespace App\Controller; #se situe dans le namespace qui doit être de même nom que celui écrit dans route.yaml

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
     return $this->render('pages/home.html.twig');
    }
}