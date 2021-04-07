<?php

    namespace App\Paypal;


    class Paypal{


        protected $apiContext;

        public function __construct(){
            $this->apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    'AdtRaXjJtHnZjZTSeH4FnNnD4tY3DU1LGxRAfiYyjXvjMC4KO__fXzUmiSJbdPPTnxjtpBYT8xkjHrg-',     // ClientID
                    'EMN0Iu4GgutNCH4RM218-RvDw2GuQnnSDzzgOPiJ1pTHMVvs020YYWWgjpjaw33FlF5OcI_x9Sr714qb'      // ClientSecret
                )
            );
        }

        

    }

?>