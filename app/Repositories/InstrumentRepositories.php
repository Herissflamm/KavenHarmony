<?php
 
 namespace App\Repositories;
  
 use App\Models\Instrument;
 
 class InstrumentRepositories{
  public static function getAllInstrument(){
    return Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->get()->first();       
  }

  public static function getAllInstrumentWithoutOrder(){
      $instrumentQuery = Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
      ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
      ->whereNull('instrument_has_order.id_instrument')
      ->get();
      return $instrumentQuery;
  }
  public static function getInstrumentByID($id){
      $instrumentQuery = Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->where('id', $id)->first();
      return $instrumentQuery;
  }

  public static function getInstrumentsByFilter($state, $type, $minPrice, $maxPrice){
      $stateId = null;
      $typeId = null;
      if($state != null){
          $stateFilter = StateRepositories::getStateByStateName($state);
          $stateId = $stateFilter->id;
      }
      if($type != null){
          $typeFilter = TypeRepositories::getTypeByTypeName($type);
          $typeId = $typeFilter->id;
      }
      $instrumentQuery = Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->join('sell', 'sell.id', '=', 'instrument.id_sell' );
      $instrumentQuery = $instrumentQuery->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id');
      $instrumentQuery = $instrumentQuery->whereNull('instrument_has_order.id_instrument');
      if($typeId != null ){      
          $instrumentQuery = $instrumentQuery->where('id_type_instrument', $typeId);
      }
      if($stateId != null){
          $instrumentQuery = $instrumentQuery->where('id_state', $stateId);
      }
      if($minPrice != null && $maxPrice != null){
          $instrumentQuery = $instrumentQuery->where('sell.price', '>=', $minPrice)->where('sell.price', '<=', $maxPrice);
      }
      $instrumentQuery = $instrumentQuery->get();
      
      return $instrumentQuery;
  }


  public static function getAllInstrumentWithSearch($value){ 
      $allInstrument= [];
      $instrumentQuery = null;
      $instrumentQuery = Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
          ->join('type_instrument', 'instrument.id_type_instrument', '=', 'type_instrument.id')
          ->join('state', 'instrument.id_state', '=', 'state.id')
          ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
          ->whereNull('instrument_has_order.id_instrument')
          ->whereAny([
              'type_instrument.type',
              'state.state',
              'instrument.name',
          ], 'LIKE', '%'.$value.'%')
          ->get();
      return $instrumentQuery;
  }

  public static function getInstrumentBySeller($id){
      $instrumentQuery = Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
      ->where('id_seller', '=', $id)->get();
      return $instrumentQuery;
  }

  public static function getInstrumentByOrderId($id){
      $instrumentQuery = Instrument::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
      ->join('instrument_has_order', 'instrument_has_order.Instrument_idInstrument', '=', 'instrument.idInstrument')
      ->where('instrument_has_order.Order_idOrder', '=', $id)
      ->get()
      ->first();
      return $instrumentQuery;
  }
}