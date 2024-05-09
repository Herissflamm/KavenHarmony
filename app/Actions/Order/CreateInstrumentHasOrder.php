<?php

namespace App\Actions\Order;

use App\Models\InstrumentHasOrder;

class CreateInstrumentHasOrder
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create($idInstrument, $idOrder): InstrumentHasOrder
    {   
                       
        $instrumentHasOrder = InstrumentHasOrder::create([
            'id_instrument' => $idInstrument,
            'id_order' => $idOrder
        ]);

        return $instrumentHasOrder;
    }
}
