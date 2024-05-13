<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'type_instrument';

    protected $fillable = [
        'type',
    ];
    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id_type_instrument");
    }

    public static function getAllType(){
        $typeQuery = DB::table('type_instrument')->get();
        return $typeQuery;
    }

    public static function getTypeByID($id){
        $val = DB::table('type_instrument')->where('id', $id)->first();
        return $val;
    }

    public static function getTypeByTypeName($type){
        $val = DB::table('type_instrument')->where('type', $type)->first();
        return $val;
    }

}
