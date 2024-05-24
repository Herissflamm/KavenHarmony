<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'order';

    protected $fillable = [
        'shipping_price',
        'total_price',
        'id_customer',
        'id_status'
    ];

    public function instrument_has_order()
    {
        return $this->belongsTo(InstrumentHasOrder::class, "id", "id_order");
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, "id_users", "id");
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class, "id", "id_status");
    }

    public function instrument()
    {
        return $this->belongsToMany(Instrument::class, 'instrument_has_order', 'id_order', 'id_instrument')->using(InstrumentHasOrder::class);
    }

    
}
