<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(InstrumentHasOrder::class, "id");
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, "id_users");
    }

    public function instrument()
    {
        return $this->belongsToMany(Order::class, 'instrument_has_order', 'id_order', 'id_instrument')->using(InstrumentHasOrder::class);
    }

    public static function getLastOpenOrderOfUser($idUser){
        $order = DB::table('order')
        ->join('order_status', 'order_status.id', '=', 'order.id_status')
        ->where('order_status.status', '=', 'En Cours')
        ->where('order.id_customer','=',$idUser)
        ->get()
        ->first();
        return $order;
    }
}
