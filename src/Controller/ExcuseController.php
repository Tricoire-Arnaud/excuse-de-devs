<?php

// src/Controller/ExcuseController.php
namespace App\Controller;

use App\Entity\Excuse;
use App\Repository\ExcuseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExcuseController extends AbstractController
{
    private EntityManagerInterface $entityManager;
   

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
      
    }

    #[Route("/", name: "app_excuses")]
    public function index(ExcuseRepository $excuseRepository): Response
    {
        $randomExcuse = $excuseRepository->findRandomExcuse();

        return $this->render('excuse/index.html.twig', [
            'randomExcuse' => $randomExcuse,
        ]);
    }

    #[Route("/lost", name: "app_lost")]
    public function lost(): Response
    {
        // Renvoyer le template "excuse/lost.html.twig"
        return $this->render('excuse/lost.html.twig');
    }

    #[Route('/{http_code}', name: 'app_error')]
    public function error($http_code, ExcuseRepository $excuseRepository): Response
    {
        $excuse = $excuseRepository->findOneBy(['httpCode' => $http_code]);
    
        if (!$excuse) {
            throw $this->createNotFoundException('Excuse not found');
        }
    
        // Générer un nouveau code HTTP aléatoire différent du code actuel
        $randomHttpCode = $this->getRandomHttpCode($http_code);
    
        return $this->render('excuse/error.html.twig', [
            'excuse' => $excuse,
            'randomHttpCode' => $randomHttpCode,
        ]);
    }


    private function getRandomHttpCode($currentHttpCode): int
    {
        $excuseRepository = $this->entityManager->getRepository(Excuse::class);
        $availableHttpCodes = $excuseRepository->findAvailableHttpCodes();
    
        // Retirer le code HTTP actuel de la liste des codes disponibles
        $key = array_search((int)$currentHttpCode, $availableHttpCodes);
        unset($availableHttpCodes[$key]);
    
        // Choisir une clé aléatoire dans le tableau des codes HTTP disponibles
        $randomKey = array_rand($availableHttpCodes);
    
        // Retourner la valeur correspondante à la clé aléatoire
        return (int)$availableHttpCodes[$randomKey];
    }
}
