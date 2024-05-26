<?php
 
 namespace App\Repositories;
  
 use App\Models\Instrument;
 
 class InstrumentRepositories{
  public static function getAllInstrument(){
    return Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->get()->first();       
  }

  public static function getAllInstrumentWithoutOrder(){
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
    ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
    ->whereNull('instrument_has_order.id_instrument')
    ->get();
    return $instrumentQuery;
  }
  public static function getInstrumentByID($id){
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->where('id', $id)->first();
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
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->join('sell', 'sell.id', '=', 'instrument.id_sell' );
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
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'image', 'order')
        ->join('type_instrument', 'type_instrument.id', '=', 'instrument.id_type_instrument')
        ->join('state', 'state.id', '=', 'instrument.id_state')
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
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
    ->where('id_seller', '=', $id)->get();
    return $instrumentQuery;
  }

  public static function getInstrumentByOrderId($id){
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
    ->join('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
    ->where('instrument_has_order.id_order', '=', $id)
    ->get()
    ->first();
    return $instrumentQuery;
  }

  public static function getInstrumentSuggest($id_type_instrument, $id_seller, $id_instrument){
    $instrumentQuery = Instrument::select('instrument.*')
    ->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
    ->where('id', '!=', $id_instrument)
    ->where(
      function($query) use($id_type_instrument, $id_seller){
        return $query
          ->where('id_type_instrument', '=', $id_type_instrument)
          ->orWhere('id_seller','=',$id_seller);
      })
    ->limit(5)
    ->get();
    return $instrumentQuery;
  }
}