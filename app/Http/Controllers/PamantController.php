<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PamantController extends Controller
{
    public function checkout()
    {
        // Set Stripe API key from environment
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            "name" => "Medical Consultation",
                            "description" => "Professional medical consultation service"
                        ],
                        'unit_amount'  => 5000, // $50.00
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('dashboard') . '?payment=success',
            'cancel_url'  => route('stripe.payement') . '?payment=cancelled',
        ]);

        return redirect()->away($session->url);
    }

    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $endpoint_secret = config('services.stripe.webhook.secret');
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        switch ($event['type']) {
            case 'checkout.session.completed':
                $session = $event['data']['object'];
                // Handle successful payment
                $this->handleSuccessfulPayment($session);
                break;
            
            case 'payment_intent.succeeded':
                $paymentIntent = $event['data']['object'];
                // Handle payment success
                break;
                
            default:
                error_log('Received unknown event type ' . $event['type']);
        }

        return response('Success', 200);
    }

    private function handleSuccessfulPayment($session)
    {
        // Update appointment status, send confirmation email, etc.
        // Implementation depends on your business logic
    }
}

