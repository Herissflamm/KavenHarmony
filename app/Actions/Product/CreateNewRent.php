<?php

namespace App\Actions\Product;

use App\Models\Rent;
use App\Models\Sell;
use Illuminate\Support\Facades\Validator;

class CreateNewRent
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input, $id_frequency): Rent
    {
                      
        Validator::make($input, [
            'price' => ['required', 'string', 'max:255'],
            'date_max' => ['required', 'date'],
        ])->validate();
        
        $rent = Rent::create([
            'price' => $input['price'],
            'duration_max' => $input['date_max'],
            'id_frequency' => $id_frequency,
        ]);


        return $rent;
    }
}
