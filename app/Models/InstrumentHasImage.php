<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;


class InstrumentHasImage extends Pivot
{
    use HasFactory;
    public $table = 'instrument_has_image';

    protected $fillable = [
      'id_instrument',
      'id_image'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, "id");
    }

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id");
    }

    public static function getAllImageByInstrumentId($id){
      $val = self::with('image')->where('id_instrument', $id)->get();
      return $val;
      
    }
    
}
