<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeu')]
    public function index(): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
        ]);
    }

    #[Route('/memory_game', name: 'jeu_memory')]
    public function memory_game(): Response
    {
        return $this->render('jeu/memory.html.twig',[
            'controller_name' => 'JeuController',
        ]);
    }

    #[Route('/calcul_game', name: 'jeu_calcul')]
    public function calcul_game(): Response
    {
        return $this->render('jeu/calcul.html.twig',[
            'controller_name' => 'JeuController',
        ]);
    }

   #[Route('/jeu3_game', name: 'jeu_jeu3')]
    public function jeu3_game(): Response
    {
        return $this->render('jeu/jeu3.html.twig',[
            'controller_name' => 'JeuController',
        ]);
    } 
}
