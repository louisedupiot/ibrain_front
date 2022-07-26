<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface ;


class ProductController extends AbstractController
{

    private $entityManager ; 

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager ;
    }

    #[Route('/Boutique', name: 'product')]
    public function index(): Response
    {

        $products = $this->entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
