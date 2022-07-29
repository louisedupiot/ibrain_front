<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Classe\Cart;
use App\Entity\Abonnement;
    
class SubscribeCartController extends AbstractController
{

        private $entityManager ;
    
        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }
    
        #[Route('/panier', name: 'cart')]
        public function index(Cart $cart)
        {
            return $this->render('cart/subscribe.html.twig', [
                "cart" => $cart->getFull(),
            ]);
        }
    
    
    
        #[Route('/cart/add/{id}', name: 'cart_to_add')]
        public function add(Cart $cart , $id)
        {
            
            $cart->add($id);
            return $this->redirectToRoute('cart');
        }
    
       
        #[Route('/cart/remove', name: 'cart_t_remove')]
        public function remove(Cart $cart)
        {
            $cart->remove();
            return $this->redirectToRoute('cart');
        }
    
        #[Route('/cart/delete/{id}', name: 'cart_to_delete')]
        public function delete(Cart $cart, $id)
        {
            $cart->delete($id);
            return $this->redirectToRoute('cart');
        }
    
        #[Route('/cart/decrease/{id}', name: 'decrease')]
        public function decrease(Cart $cart, $id)
        {
            $cart->decrease($id);
            return $this->redirectToRoute('cart');
        }
    }
    


    
