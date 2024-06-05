<?php

namespace App\Actions\Order;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateOrder
{
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function update($order)
    {       
        $order->id_status = 1;
        $order->save();        
    }

    public function updatePrice($order, $price){
        $order->total_price += $price;
        $order->save();
    }
}
