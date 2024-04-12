<?php

namespace App\Actions\Product;

use App\Models\Instrument;
use App\Models\Adress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewProduct
{
    /**
     * Validate and create a newly registered user.
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
            'idTypeInstrument' => $idTypeInstrument,
            'State_idState' => $idState,
            'SelleridUser' => $idUser,
            'Sell_idSell' => $idSell,
        ]);


        return $product;
    }
}
