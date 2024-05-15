<?php
 
 namespace App\Repositories;
  
 use App\Models\InstrumentHasOrder;
 use Illuminate\Support\Facades\DB;
 
 class InstrumentHasImageRepositories{
  public static function getAllImageByInstrumentId($id){
    $val = InstrumentHasOrder::with('image')->where('id_instrument', $id)->get();
    return $val;
  }
}