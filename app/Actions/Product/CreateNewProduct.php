<?php

namespace App\Actions\Product;

use App\Models\Instrument;
use Illuminate\Support\Facades\Validator;


class CreateNewProduct
{
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input, $idTypeInstrument, $idState, $idUser, $idSell): Instrument
    {
                      
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255']
        ])->validate();

        $product = Instrument::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'id_type_instrument' => $idTypeInstrument,
            'id_state' => $idState,
            'id_seller' => $idUser,
            'id_sell' => $idSell,
        ]);


        return $product;
    }
}
