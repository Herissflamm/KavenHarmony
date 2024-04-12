<?php

namespace App\Models;

use App\Builder\ImageBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Builder\SellBuilder;


class InstrumentHasImage extends Model
{
    use HasFactory;
    public $table = 'instrument_has_image';
    public $timestamps = false;

    protected $fillable = [
      'Instrument_idInstrument',
      'Image_idImage'
    ];

    public static function getAllImageByInstrumentId($id){
      $val = DB::table('instrument_has_image')->where('Instrument_idInstrument', $id)->get();
      $allImage= [];
      if($val!= null){
        foreach($val as $image){
          $allImage[] = Image::getImageByID($image->Image_idImage);
        }
      }
      return $allImage;
      
    }
    
}
