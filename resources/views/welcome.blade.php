{{-- <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
  </head>
  
  <body>
    <div id="paypal-button"></div>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
        sandbox: 'AdtRaXjJtHnZjZTSeH4FnNnD4tY3DU1LGxRAfiYyjXvjMC4KO__fXzUmiSJbdPPTnxjtpBYT8xkjHrg-',
        production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
        size: 'small',
        color: 'gold',
        shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
        return actions.payment.create({
            redirect_urls:{
                return_url:'http://localhost:8000/execute-payment'
            },
            transactions: [{
            amount: {
                total: '0.01',
                currency: 'USD'
            }
            }]
        });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
             return actions.redirect();
        }
    }, '#paypal-button');

    </script>
  </body> --}}


  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
  </head>
  <body>
      <div class="container">
        <form action="{{ route('create-payment') }}" method="post">
            @csrf
            <input type="submit" value="Pay Now">
        </form>
      </div>
  </body>
  </html>