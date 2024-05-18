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
    public function create($price, $userId): Order
    {
        $order = Order::create([
            'shipping_price' => 0,
            'total_price' => $price,
            'id_customer' => $userId,
            'id_status' => 3
        ]);


        return $order;
    }
}
