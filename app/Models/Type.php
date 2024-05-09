<?php

namespace App\Models;

use App\Builder\TypeBuilder;
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
        $TypeQuery = DB::table('type_instrument')->get();
        $allType = [];
        foreach($TypeQuery as $type){
            $allType[] = new TypeBuilder($type->id, $type->type);
        }
        return $allType;
    }

    public static function getTypeByID($id){
        $val = DB::table('type_instrument')->where('id', $id)->first();
        $type = new TypeBuilder($val->id, $val->type);
        return $type;
    }

    public static function getTypeByTypeName($type){
        $val = DB::table('type_instrument')->where('type', $type)->first();
        $type = new TypeBuilder($val->id, $val->type);
        return $type;
    }

}
