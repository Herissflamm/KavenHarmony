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

    protected $fillable = [
      'id_instrument',
      'id_image'
    ];

    public function image()
    {
        return $this->hasOne(Image::class, "id");
    }

    public function instrument()
    {
        return $this->hasOne(Instrument::class, "id");
    }

    public static function getAllImageByInstrumentId($id){
      $val = DB::table('instrument_has_image')->where('id_instrument', $id)->get();
      $allImage= [];
      if(!empty($val)){
        foreach($val as $image){
          $allImage[] = Image::getImageByID($image->id_image);
        }
      }
      return $allImage;
      
    }
    
}
