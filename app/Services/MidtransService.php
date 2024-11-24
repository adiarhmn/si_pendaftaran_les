<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        
    }

    public function createTransaction($orderId, $grossAmount, $customerDetails)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => $customerDetails,
        ];

        return Snap::createTransaction($params)->redirect_url;
    }
}
