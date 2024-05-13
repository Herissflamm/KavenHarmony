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
        return $this->hasOne(Order::class, "id");
    }

    public function instrument()
    {
        return $this->hasOne(Instrument::class, "id");
    }

    public static function getAllInstrumentByOrderId($id){
        $val = self::with('instrument')->where('Order_idOrder', $id)->get();
        return $val;
        
      }

      public static function getAllInstrumentOfOrderByUserId($id){
        $val = self::with('instrument')
        ->join('order', 'order.id', '=', 'instrument_has_order.id_order')
        ->join('customer', 'customer.id_users', '=', 'order.id_customer')
        ->where('customer.id_users', $id)->get();
        return $val;
        
      }

      public static function deleteInstrumentFromOrder($id){
        InstrumentHasOrder::where('id_instrument', $id)->delete();        
      }
    
}
