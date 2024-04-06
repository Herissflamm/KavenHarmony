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
    public function create(array $input, int $idImage, $idTypeInstrument, $idState, $idUser): Instrument
    {
                      
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();
        
        $product = Instrument::create([
            'name' => $input['name'],
            'idTypeInstrument' => $idTypeInstrument,
            'idState' => $idState,
            'SelleridUser' => $idUser,
            'idImage' => $idImage,
        ]);


        return $product;
    }
}
