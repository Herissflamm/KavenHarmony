<?php
 
 namespace App\Repositories;
  
 use App\Models\InstrumentHasImage;

 
 class InstrumentHasImageRepositories{
  public static function getAllImageByInstrumentId($id){
    $val = InstrumentHasImage::select('instrument_has_image.*')->with('image')->where('id_instrument', $id)->get();
    return $val;
  }
}