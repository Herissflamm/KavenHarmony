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

    protected $primaryKey = 'idState';
    public $table = 'state';
    public $timestamps = false;

    protected $fillable = [
        'state',
    ];

    public function profile()
    {
        return $this->belongsTo(Instrument::class, "idState");
    }


    public static function getAllState(){
        $StateQuery = DB::table('state')->get();
        $allState = [];
        foreach($StateQuery as $state){
            $allState[] = new StateBuilder($state->idState, $state->state);
        }
        return $allState;
    }

    public static function getStateByID($id){
        $val = DB::table('state')->where('idState', $id)->first();
        $state = new StateBuilder($val->idState, $val->state);
        return $state;
    }

    public function getId(){
        return $this->id;
    }

    public function getState(){
        return $this->state;
    }
}
