<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use App\Paypal\CreatePayment;

class PaymentController extends Controller
{

    public function create(){
        $payment = new CreatePayment;
        return $payment->create();
    }

    public function execute(){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdtRaXjJtHnZjZTSeH4FnNnD4tY3DU1LGxRAfiYyjXvjMC4KO__fXzUmiSJbdPPTnxjtpBYT8xkjHrg-',     // ClientID
                'EMN0Iu4GgutNCH4RM218-RvDw2GuQnnSDzzgOPiJ1pTHMVvs020YYWWgjpjaw33FlF5OcI_x9Sr714qb'      // ClientSecret
            )
        );

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(1.2)
        ->setTax(1.3)
        ->setSubtotal(17.50);

        $amount->setCurrency('USD');
        $amount->setTotal(21);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $result = $payment->execute($execution, $apiContext);

        return $result;
    }
}
