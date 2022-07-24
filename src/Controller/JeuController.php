<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Process;
Use Symfony\Component\Process\Exception\ProcessFailedException;


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
    public function memory_game(Request $request): Response
    {

        /*$pathToHelloWorldScript = ".\games\demineur-easy.py";
        $process = Process::fromShellCommandline('C:\Users\Anzid\AppData\Local\Programs\Python\Python39\python.exe', $pathToHelloWorldScript);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
       
        //echo $process->getOutput();*/


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

   #[Route('/demineur_game', name: 'jeu_demineur')]
    public function demineur_game(): Response
    {
        return $this->render('jeu/demineur.html.twig',[
            'controller_name' => 'JeuController',
        ]);
    } 
}
