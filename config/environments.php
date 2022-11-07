<?php

return [
     /*
    |--------------------------------------------------------------------------
    | Environments for webhooks calls
    |--------------------------------------------------------------------------
    |
    | This file is for storing the environments that webhook calls will be
    | route to.
    |
    */

    'defaults' => [
        'https://api-onetime-orders.edenlife.ng/api/v2/track/paystack/payment',
        'https://api-staging-testanything.edenlife.ng/api/v2/track/paystack/payment',
        'https://api-plg-wallet.edenlife.ng/api/v2/track/paystack/payment'
    ]
];
