<?php

namespace App\Actions\Product;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateSell
{
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function update(Request $request, $sell)
    {       
        $input = $request->all();

        $sell->price = $input['price'];        

        $sell->save();        
    }
}
