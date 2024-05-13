<?php

namespace App\Models;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'state';
    protected $fillable = [
        'state',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "idState");
    }


    public static function getAllState(){
        $stateQuery = DB::table('state')->get();
        return $stateQuery;
    }

    public static function getStateByID($id){
        $val = DB::table('state')->where('id', $id)->first();
        return $val;
    }

    public static function getStateByStateName($state){
        $val = DB::table('state')->where('state', $state)->first();
        return $val;
    }

    public function getId(){
        return $this->id;
    }

    public function getState(){
        return $this->state;
    }
}
