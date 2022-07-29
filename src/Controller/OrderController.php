<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\SubscribeCart;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Entity\Product;
use App\Form\OrderType;
use DateTime;
use DateTimeImmutable;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/commande', name: 'order')]
    public function index(Cart $cart, Request $request): Response
    {


        $form = $this->createForm(OrderType::class, null, [
            "user" => $this->getUser(),

        ]);

        $form->handlerequest($request);

        if ($form->isSubmitted() &&  $form->isValid()) {
        }
        return $this->render(
            'order/index.html.twig',
            [
                'form' => $form->createView(),
                'cart' => $cart->getFull()
            ]
        );
    }


    #[Route('/commande/abonnement', name: 'Subscribe_order')]
    public function SubscribeOrder(SubscribeCart $cart, Request $request): Response
    {


        $form = $this->createForm(OrderType::class, null, [
            "user" => $this->getUser(),

        ]);

        $form->handlerequest($request);

        if ($form->isSubmitted() &&  $form->isValid()) {
        }
        return $this->render(
            'order/recap_abonnement.html.twig',
            [
                'form' => $form->createView(),
                'cart' => $cart->getFullSubscribe()
            ]
        );
    }

    #[Route('/commande/recap', name: 'order_recap')]
    public function add(Cart $cart, Request $request): Response
    {
        $YOUR_DOMAIN = 'http://localhost:8000';

        $form = $this->createForm(OrderType::class, null, [
            "user" => $this->getUser()
        ]);

        $form->handlerequest($request);



        $date = new DateTimeImmutable();
        $order = new Order();
        $order->setUser($this->getUser());
        $order->setCreatedAt($date);
        $order->setIsPaid(0);

        $this->entityManager->persist($order);


        $product_stripe = [];
        foreach ($cart->getFull() as $product) {

            $orderDetails = new OrderDetails();

            $orderDetails->setMyOrder($order);
            $orderDetails->setProduct($product['product']->getName());
            $orderDetails->setQuantity($product['quantity']);
            $orderDetails->setPrice($product["product"]->getPrix());
            $orderDetails->setTotal($product["product"]->getPrix() * $product['quantity']);
            $this->entityManager->persist($orderDetails);


            $product_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product['product']->getName(),

                    ],
                    'unit_amount' => $product["product"]->getPrix(),
                ],
                'quantity' => $product['quantity'],

            ];
        }
        //dd($product_stripe);
        // $this->entityManager->flush();

        Stripe::setApiKey('sk_test_51LPRdnCK4WaiiCIrSDsH3Sz3nMXI0IX9wpUWlpxE8WjRNGPiQgDSHF0NWFhbh8lR1MZkuVQT2AfQZa1A6HYJ4FAh00yupbBLki');

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $product_stripe
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);



        return $this->render(
            'order/add.html.twig',
            [
                'cart' => $cart->getFull(),
                'stripe_checkout_session' => $checkout_session->id
            ]
        );
    }


    #[Route('/commande/recap-abonnement', name: 'order_subscribe_recap')]
    public function add_subscribe(SubscribeCart $cart, Request $request): Response
    {
        $YOUR_DOMAIN = 'http://localhost:8000';

        $form = $this->createForm(OrderType::class, null, [
            "user" => $this->getUser()
        ]);

        $form->handlerequest($request);
       
      

        $date = new DateTimeImmutable();
        $order = new Order();
        $order->setUser($this->getUser());
        $order->setCreatedAt($date);
        $order->setIsPaid(0);

        $this->entityManager->persist($order);


        foreach ($cart->getFullSubscribe() as $abonnement) {

            $orderDetails = new OrderDetails();

            $orderDetails->setMyOrder($order);
            $orderDetails->setProduct($abonnement['abonnement']->getNom());
            $orderDetails->setQuantity($abonnement['quantity']);
            $orderDetails->setPrice($abonnement["abonnement"]->getPrix());
            $orderDetails->setTotal($abonnement["abonnement"]->getPrix() * $abonnement['quantity']);
            $this->entityManager->persist($orderDetails);


        }
        //dd($abonnement_stripe);
         $this->entityManager->flush();

      

        return $this->render(
            'order/add_abonnement.html.twig',
            [
                'cart' => $cart->getFullSubscribe(),
            ]
        );
    }
}
