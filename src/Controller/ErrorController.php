<?php

// src/Controller/ErrorController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ErrorController extends AbstractController
{
    #[Route("/error404", name: "app_error_404")]
    public function error404()
    {
        return $this->render('error/error404.html.twig');
    }
}
