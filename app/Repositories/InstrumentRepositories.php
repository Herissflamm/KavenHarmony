<?php
 
 namespace App\Repositories;
  
 use App\Models\Instrument;
 use Illuminate\Support\Facades\Log;

 
 class InstrumentRepositories{
  public static function getAllInstrument(){
    return Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->get()->first();       
  }

  public static function getAllInstrumentWithoutOrder(){
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
    ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
    ->leftjoin('sell', 'sell.id', '=', 'instrument.id_sell' )
    ->leftjoin('rent', 'rent.id', '=', 'instrument.id_rent' )
    ->whereNull('instrument_has_order.id_instrument')
    ->orderBy('rent.price')
    ->orderBy('sell.price')
    ->get();
    return $instrumentQuery;
  }
  public static function getInstrumentByID($id){
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->where('id', $id)->first();
    return $instrumentQuery;
  }

  public static function getInstrumentsByFilter($state, $type, $minPrice, $maxPrice, $rentSearch, $sellSearch){
    $stateId = null;
    $typeId = null;
    if($state != null){
        $stateId = StateRepositories::getStateByStateName($state)->id;
    }
    if($type != null){
        $typeId = TypeRepositories::getTypeByTypeName($type)->id;
    }
    $instrumentQuery = Instrument::select('instrument.*')
    ->with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
    ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id');
    if(($rentSearch == "true") && ($sellSearch == "true")){      
      $instrumentQuery->leftJoin('rent', 'rent.id', '=', 'instrument.id_rent' )
      ->leftJoin('sell', 'sell.id', '=', 'instrument.id_sell' );
    }else if($rentSearch == "true"){
      $instrumentQuery->join('rent', 'rent.id', '=', 'instrument.id_rent' );
    }else if($sellSearch == "true"){
      $instrumentQuery->join('sell', 'sell.id', '=', 'instrument.id_sell' );
    }
    
    $instrumentQuery = $instrumentQuery
    ->whereNull('instrument_has_order.id_instrument');
    if($typeId != null ){      
      $instrumentQuery = $instrumentQuery->where('id_type_instrument', $typeId);
    }
    if($stateId != null){
      $instrumentQuery = $instrumentQuery->where('id_state', $stateId);
    }
    if($minPrice != null && $maxPrice != null){
      if($rentSearch == "true" && $sellSearch == "true"){      
        $instrumentQuery = $instrumentQuery->whereAny(['sell.price', 'rent.price'], '>=', $minPrice)
        ->whereAny(['sell.price', 'rent.price'], '<=', $maxPrice)
        ->orderBy('rent.price')
        ->orderBy('sell.price');
      }else if($rentSearch == "true"){
        $instrumentQuery->where('rent.price', '>=', $minPrice )
        ->orderBy('rent.price');
      }else if($sellSearch == "true"){
        $instrumentQuery->where('sell.price', '>=', $minPrice )
        ->orderBy('sell.price');
      }
        
    }
    $instrumentQuery = $instrumentQuery->get();
    
    return $instrumentQuery;
  }


  public static function getAllInstrumentWithSearch($value){ 
    $instrumentQuery = Instrument::select('instrument.*')->with('state', 'type_instrument', 'seller', 'sell',  'image', 'order', 'rent')
    ->leftjoin('sell', 'sell.id', '=', 'instrument.id_sell' )
    ->leftjoin('rent', 'rent.id', '=', 'instrument.id_rent' )
    ->join('type_instrument', 'type_instrument.id', '=', 'instrument.id_type_instrument')
    ->join('state', 'state.id', '=', 'instrument.id_state')
    ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
    ->whereNull('instrument_has_order.id_instrument')
    ->whereAny([
        'type_instrument.type',
        'state.state',
        'instrument.name'
    ], 'LIKE',"%{$value}%")
    ->orderBy('rent.price')
    ->orderBy('sell.price')
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