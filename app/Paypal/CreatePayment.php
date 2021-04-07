<?php

    namespace App\Paypal;
    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;
    use PayPal\Api\Transaction;
    
    
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Payer;
    use PayPal\Api\RedirectUrls;


    class CreatePayment extends Paypal{

        public function create(){
            $item1 = new Item();
            $item1->setName('Ground Coffee 40 oz')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setSku("123123") // Similar to `item_number` in Classic API
                ->setPrice(7.5);
            $item2 = new Item();
            $item2->setName('Granola bars')
                ->setCurrency('USD')
                ->setQuantity(5)
                ->setSku("321321") // Similar to `item_number` in Classic API
                ->setPrice(2);

            $itemList = new ItemList();
            $itemList->setItems(array($item1, $item2));

            $payment = $this->Payment(
                $itemList
            );
        
            return redirect($payment->getApprovalLink());

        }

        protected function Payer(): Payer{
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            return $payer;
        }

        protected function Details(): Details{
            
            $details = new Details();
            $details->setShipping(1.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);
            return $details;
        }

        public function Amount(): Amount{
            $amount = new Amount();
            $amount->setCurrency("USD")
                ->setTotal(20)
                ->setDetails($this->Details());

            return $amount;
        }

        public function Transaction($itemList): Transaction{
            $transaction = new Transaction();
            $transaction->setAmount($this->Amount())
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());
            return $transaction;
        }

        public function RedirectUrls(): RedirectUrls{
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl('http://localhost:8000/execute-payment')
                ->setCancelUrl('http://localhost:8000/cancel');

            return $redirectUrls;
        }

        public function Payment($itemList): Payment{
            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($this->Payer())
                ->setRedirectUrls($this->RedirectUrls())
                ->setTransactions(array($this->Transaction($itemList)));
            
            $payment->create($this->apiContext);
            return $payment;
        }
    }


?>