<?php

namespace App\Actions\Order;

use App\Models\IsRenting;
use App\Models\Order;
use Carbon\Carbon;

class CreateIsRenting
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create($date_end, $userId, $id_instrument): IsRenting
    {
        $order = IsRenting::create([
            'date_start' => Carbon::now(),
            'date_end' => $date_end,
            'id_customer' => $userId,
            'id_instrument' => $id_instrument,
        ]);


        return $order;
    }
}
