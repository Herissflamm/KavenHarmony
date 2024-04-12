<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Builder\SellBuilder;


class Sell extends Model
{
    use HasFactory;

    protected $primaryKey = 'idSell';
    public $table = 'sell';
    public $timestamps = false;

    protected $fillable = [
      'price',
    ];

    public static function getSellByID($id){
        $val = DB::table('sell')->where('idSell', $id)->first();
        $state = new SellBuilder($val->idSell, $val->price);
        return $state;
    }
    
}
