<?php

namespace App\Models;

use App\Builder\StateBuilder;
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
        $StateQuery = DB::table('state')->get();
        $allState = [];
        foreach($StateQuery as $state){
            $allState[] = new StateBuilder($state->id, $state->state);
        }
        return $allState;
    }

    public static function getStateByID($id){
        $val = DB::table('state')->where('id', $id)->first();
        $state = new StateBuilder($val->id, $val->state);
        return $state;
    }

    public static function getStateByStateName($state){
        $val = DB::table('state')->where('state', $state)->first();
        $state = new StateBuilder($val->id, $val->state);
        return $state;
    }

    public function getId(){
        return $this->id;
    }

    public function getState(){
        return $this->state;
    }
}
