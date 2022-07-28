<?php

namespace App\Controller;

use App\Classe\Cart;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/commande/create-session', name: 'stripe_create_session')]
    public function index(Cart $cart): Response
    {
        $YOUR_DOMAIN = 'http://localhost:8000';

        $product_stripe = [];

        foreach ($cart->getFull() as $product) {
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

        $response = new JsonResponse(['id' => $checkout_session->id]);

        return $response;
    }
}
