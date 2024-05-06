<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Charge;
use Stripe\Webhook;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use App\Http\Controllers\OrderController;
use App\Models\User;
use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use Auth;

class StripeController extends Controller
{
    public function checkout()
    {
        $order = session('order');
        $payment_method_types = 'card';
        switch (session('order')->payment) {
            case 0:
                $payment_method_types = 'card';
                break;
            case 1:
                $payment_method_types = 'konbini';
                break;
            case 2:
                $payment_method_types = 'customer_balance';
                break;
            default:
                break;
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        // Stripe::setApiKey(env('STRIPE_SECRET'));        //シークレットキー
        $customer = $stripe->customers->create([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'address' => [
                'postal_code' => $order->address->postcode,
                'line1' => $order->address->address,
                'line2' => $order->address->building,
            ]
        ]);
        $session = $stripe->checkout->sessions->create([
           'customer' => $customer->id,
           'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'JPY',
                        'product_data' => [
                            'name' => $order->item->name,
                        ],
                        'unit_amount' => $order->item->price,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'payment_method_types' => [$payment_method_types,],
            // 'payment_method_types' => [
            //     'card',
            //     'konbini',
            //     'customer_balance',
            // ],
            'payment_method_options' => [
                'customer_balance' => [
                    'funding_type' => 'bank_transfer',
                    'bank_transfer' => [
                        'type'=> 'jp_bank_transfer',
                    ],
                ],
            ],
            'metadata' => [
                'item_id' => $order->item->id,
            ],
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        return view('success');
    }

    public function cancel(Request $request)
    {
        return view('cancel');
    }

    public function webhook(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $stripe->paymentIntents->search(['query' => 'metadata[\'payment_intent\']:\'value\'']);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $endpoint_secret = 'whsec_23756bea53d38245f95b446929474de43a09ac594ce8bc31251fdc68108282a2'; 
        //Stripe CLIで表示

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch (SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;
            $this->handle_checkout_session($session);
        }

        http_response_code(200);
    }

    public function handle_checkout_session($session)
    {
        // userの取得
        $user = User::Where('email', '=', $session['customer_details']['email'])->first();

        // item_idの取得
        $item_id = $session['metadata']['item_id'];

        // orderの作成
        $order = new Order();
        $order->init($item_id, $user);

        $address_session = $session['customer_details']['address'];
        $address = new Address();
        $address->postcode = $address_session['postal_code'];
        $address->address = $address_session['line1'];
        $address->building = $address_session['line2'];

        $orderController = new OrderController();
        $orderController->create($order, $address);
    }
}
