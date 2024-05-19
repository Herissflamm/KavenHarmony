<?php

namespace App\Actions\Product;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UpdateProduct
{
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function update(Request $request, $product, $id_state, $id_type): Instrument
    {       
        $input = $request->all();

        // Ajoutez ceci avant la sauvegarde pour voir les valeurs avant mise à jour
        Log::info('Intial value:', [
            'id_type_instrument' => $product->id_type_instrument,
            'type_instrument' => $product->type_instrument->id
        ]);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255']
        ])->validate();
        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->id_type_instrument = $id_type;
        $product->id_state = $id_state;
        

        // Ajoutez ceci avant la sauvegarde pour voir les valeurs avant mise à jour
        Log::info('Before save:', [
            'id_type_instrument' => $product->id_type_instrument,
            'type_instrument' => $product->type_instrument->id
        ]);

        $product->save();

        // Ajoutez ceci après la sauvegarde et avant le rechargement pour voir les valeurs sauvegardées
        Log::info('After save:', [
            'id_type_instrument' => $product->id_type_instrument,
            'type_instrument' => $product->type_instrument->id
        ]);

        $product->fresh();

        // Ajoutez ceci après le rechargement pour voir les valeurs rechargées
        Log::info('After refresh:', [
            'id_type_instrument' => $product->id_type_instrument,
            'type_instrument' => $product->type_instrument->id
        ]);

        $product->load('type_instrument', 'state');

        // Ajoutez ceci pour vérifier les relations après chargement
        Log::info('After load:', [
            'id_type_instrument' => $product->id_type_instrument,
            'type_instrument' => $product->type_instrument->id
        ]);
        return $product;
    }
}
