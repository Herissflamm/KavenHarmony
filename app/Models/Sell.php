<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Builder\SellBuilder;


class Sell extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'sell';

    protected $fillable = [
      'price',
      'id_discount'
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id");
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, "id");
    }

    public static function getSellByID($id){
        $val = DB::table('sell')->where('id', $id)->first();
        $state = new SellBuilder($val->id, $val->price);
        return $state;
    }
    
}
