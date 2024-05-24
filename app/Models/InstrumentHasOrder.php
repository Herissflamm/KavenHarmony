<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;


class InstrumentHasOrder extends Pivot
{
    use HasFactory;
    public $table = 'instrument_has_Order';

    protected $fillable = [
      'id_instrument',
      'id_order'
    ];

    public function order()
    {
        return $this->hasOne(Order::class, "id", "id_order");
    }

    public function instrument()
    {
        return $this->hasOne(Instrument::class, "id", "id_instrument");
    }
    
}
