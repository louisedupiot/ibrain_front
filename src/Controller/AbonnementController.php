<?php

namespace App\Controller;

use App\Entity\Abonnement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\AbonnementRepository;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(Abonnement $abonnement): Response
    {
        return $this->render('product/detail.html.twig', [
            'Abonnement' => $abonnement,
        ]);
    }
}
