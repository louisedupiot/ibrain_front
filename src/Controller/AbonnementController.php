<?php

namespace App\Controller;

use App\Entity\Abonnement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AbonnementController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/abonnement', name: 'abonnements')]
    public function index(): Response
    {


        $abonnement = $this->entityManager->getRepository(Abonnement::class)->findAll();
        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnement,
        ]);
    }


    #[Route('/abonnement/{slug}', name: 'abonnement')]
    public function show($slug): Response
    {

        $abonnement = $this->entityManager->getRepository(Abonnement::class)->findOneBySlug($slug);
        if (!$abonnement) {
            return $this->redirectToRoute('abonnements');
        }
        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }
}
