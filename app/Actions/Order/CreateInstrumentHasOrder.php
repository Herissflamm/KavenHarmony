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
            'Instrument_idInstrument' => $idInstrument,
            'Order_idOrder' => $idOrder
        ]);

        return $instrumentHasOrder;
    }
}
