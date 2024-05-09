<?php

namespace App\Models;

use App\Builder\OrderBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Builder\SellBuilder;


class InstrumentHasOrder extends Model
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
        $val = DB::table('instrument_has_order')->where('Order_idOrder', $id)->get();
        $allInstruments= [];
        if($val!= null){
          foreach($val as $instrument){
            $allInstruments[] = Instrument::getInstrumentByID($instrument->Instrument_idInstrument);
          }
        }
        return $allInstruments;
        
      }

      public static function getAllInstrumentOfOrderByUserId($id){
        $val = DB::table('instrument_has_order')
        ->join('order', 'order.id', '=', 'instrument_has_order.id_order')
        ->join('customer', 'customer.id_users', '=', 'order.id_customer')
        ->where('customer.id_users', $id)->get();
        $allInstruments= [];
        if(!empty($val)){
          foreach($val as $instrument){
            $allInstruments[] = Instrument::getInstrumentByID($instrument->id_instrument);
          }
        }
        return $allInstruments;
        
      }

      public static function deleteInstrumentFromOrder($id){
        InstrumentHasOrder::where('id_instrument', $id)->delete();        
      }
    
}
