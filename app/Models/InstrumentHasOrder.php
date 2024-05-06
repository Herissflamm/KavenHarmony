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
    public $timestamps = false;

    protected $fillable = [
      'Instrument_idInstrument',
      'Order_idOrder'
    ];

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
        ->join('order', 'order.idOrder', '=', 'instrument_has_order.Order_idOrder')
        ->join('users', 'users.idUsers', '=', 'order.Customer_User_idUser')
        ->where('users.idUsers', $id)->get();
        $allInstruments= [];
        if($val!= null){
          foreach($val as $instrument){
            $allInstruments[] = Instrument::getInstrumentByID($instrument->Instrument_idInstrument);
          }
        }
        return $allInstruments;
        
      }

      public static function deleteInstrumentFromOrder($id){
        InstrumentHasOrder::where('Instrument_idInstrument', $id)->delete();        
      }
    
}
