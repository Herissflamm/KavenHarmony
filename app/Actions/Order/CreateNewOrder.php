<?php

namespace App\Actions\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class CreateNewOrder
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input, $userId): Order
    {
        
        $order = Order::create([
            'shipping_price' => 0,
            'total_price' => 0,
            'id_customer' => $userId,
            'id_status' => 1
        ]);


        return $order;
    }
}
