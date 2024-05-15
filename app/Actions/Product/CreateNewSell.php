<?php

namespace App\Actions\Product;

use App\Models\Sell;
use Illuminate\Support\Facades\Validator;

class CreateNewSell
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Sell
    {
                      
        Validator::make($input, [
            'price' => ['required', 'string', 'max:255']
        ])->validate();
        
        $sell = Sell::create([
            'price' => $input['price'],
        ]);


        return $sell;
    }
}
