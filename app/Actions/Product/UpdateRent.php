<?php

namespace App\Actions\Product;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateRent
{
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function update(Request $request, $rent, $id_frequency)
    {       
        $input = $request->all();

        $rent->price = $input['price'];
        $rent->duration_max = $input['date_max'];        
        $rent->id_frequency = $id_frequency;
        $rent->save();        
    }
}
