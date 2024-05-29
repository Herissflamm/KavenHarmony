<?php
 
 namespace App\Repositories;
  
 use App\Models\InstrumentHasOrder;
 use Illuminate\Support\Facades\DB;
 
 class InstrumentHasOrderRepositories{
  public static function getAllInstrumentByOrderId($id){
    $val = InstrumentHasOrder::select('instrument_has_order.*')->with('instrument')->where('Order_idOrder', $id)->get();
    return $val;
    
  }

  public static function getAllInstrumentOfOrderByUserId($id){
    $val = InstrumentHasOrder::select('instrument_has_order.*')->with('instrument' )
    ->join('order', 'order.id', '=', 'instrument_has_order.id_order')
    ->join('customer', 'customer.id_users', '=', 'order.id_customer')
    ->where('customer.id_users', $id)->get();
    return $val;
    
  }

  public static function deleteInstrumentFromOrder($id){
    InstrumentHasOrder::where('id_instrument', $id)->delete();        
  }
}