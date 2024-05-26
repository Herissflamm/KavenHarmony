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
    public function update(Request $request, $rent)
    {       
        $input = $request->all();

        $rent->price = $input['rent'];        

        $rent->save();        
    }
}
