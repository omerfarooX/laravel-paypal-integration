<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Userdesk\Subscription\Classes\SubscriptionConsumer;
use Userdesk\Subscription\Classes\SubscriptionProduct;
use Userdesk\Subscription\Facades\Subscription;


class PaypalController extends Controller
{
    public function payThroughPaypal()
    {
        $processor = Subscription::processor('Paypal');

        $userData = array(
            'name' => 'jack Danyials',
            'address' => 'Times Square',
            'city' => 'New York',
            'state' => 'KPK',
            'zip' => 20213,
            'country' => 'United States',
            'email' => 'test@example.com',
            'phone' => '+11231231232'
        );
        $consumer = new SubscriptionConsumer($userData['name'], $userData['address'], $userData['city'], $userData['state'], $userData['zip'], $userData['country'], $userData['email'], $userData['phone'] );


        $productData = array(
            'title' => 'Product name',
            'price' => 50.5,
            'description' => 'This is the description of the product',
            'ipnUrl' => url('ipn-resolver'),
            'returnUrl' => url('payment-sucessfull'),
            'cancelUrl' => url('paypal-cancel'),
            'frequency' => 1,
            'recurrence' => 'month',
            'discount' => 45.0,
        );
        $product = new SubscriptionProduct($productData['title'], $productData['price'], $productData['description'], $productData['ipnUrl'], $productData['returnUrl'], $productData['cancelUrl'], $productData['discount'], $productData['frequency'], $productData['recurrence'], $productData['discount'] );

        // Generating a random cart id
        $id = Str::random(30);

        $processor->complete($id, $product, $consumer);
    }


    public function resolveIpn(){
        // This is where Paypal will send the notification
        // Verify that the Paypal's notification is correct
    }

    public function paymentSuccess(){
        // Once the payment is successful the user will be redirected over here
    }

    public function paymentCancel(){
        // If the payment is canceled on the paypal's website, the user will be redirected over here
    }
}
