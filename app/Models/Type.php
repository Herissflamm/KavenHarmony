<?php

namespace App\Models;

use App\Builder\TypeBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTypeInstrument';
    public $table = 'typeInstrument';
    public $timestamps = false;

    protected $fillable = [
        'type',
    ];
    public function profile()
    {
        return $this->belongsTo(Instrument::class, "idTypeInstrument");
    }

    public static function getAllType(){
        $TypeQuery = DB::table('typeinstrument')->get();
        $allType = [];
        foreach($TypeQuery as $type){
            $allType[] = new TypeBuilder($type->idTypeInstrument, $type->type);
        }
        return $allType;
    }

    public static function getTypeByID($id){
        $val = DB::table('typeinstrument')->where('idTypeInstrument', $id)->first();
        $type = new TypeBuilder($val->idTypeInstrument, $val->type);
        return $type;
    }

}
