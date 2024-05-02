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
            'shippingPrice' => 0,
            'totalPrice' => 0,
            'Customer_User_idUser' => $userId,
            'OrderStatus_idOrderStatus' => 1
        ]);


        return $order;
    }
}
