<?php

namespace App\Actions\Product;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UpdateProduct
{
    /**
     * Validate and modify a existing product.
     *
     * @param  array<string, string>  $input
     * @param  Instrument  $product
     * @param  int  $id_state
     * @param  int  $id_type
     */
    public function update(Request $request, $product, $id_state, $id_type): Instrument
    {       
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
        ])->validate();
        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->id_type_instrument = $id_type;
        $product->id_state = $id_state;

        $product->save();
        $product->load('type_instrument', 'state');
        return $product;
    }
}
