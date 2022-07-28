<?php

namespace App\Classe;

use App\Entity\Abonnement;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;

class SubscribeCart
{

    private $session;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }


    public function add($id)
    {
        //dd($id);
      
        $cart = $this->session->getSession()->get('cart');
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->getSession()->set('cart', $cart);
    }


    public function get()
    {
        return $this->session->getCurrentRequest()->getSession()->get('cart', []);
    }

    public function remove()
    {
        $this->session->getSession()->remove('cart');
    }
    public function delete($id)
    {
        $cart = $this->session->getSession()->get('cart');

        unset($cart[$id]);
        return $this->session->getSession()->set('cart', $cart);
    }

    public function decrease($id)
    {
        $cart = $this->session->getSession()->get('cart');

        if ($cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }
        return $this->session->getSession()->set('cart', $cart);
    }


    public function getFullSubscribe()
    {
        //dd($this->entityManager->getRepository(Product::class)->findOneById(7));
        
        $CartComplete = [];
        if ($this->get()) {

            foreach ($this->get() as $id => $quantity) {

                $abonnement_object = $this->entityManager->getRepository(Abonnement::class)->findOneById($id);

                if (!$abonnement_object) {
                    $this->delete($id);
                    continue;
                }
                $CartComplete[] = [
                    'abonnement' => $abonnement_object,
                    'quantity' => $quantity
                ];
            }
        }
        return $CartComplete;
    }
}
