<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Builder\AdressBuilder;

class Adress extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAdress';
    public $table = 'adress';
    public $timestamps = false;

    protected $fillable = [
        'city',
        'postCode',
        'streetNumber',
        'street',
    ];

    public function profile()
    {
        return $this->belongsTo(User::class, "idAdress");
    }

    public static function getAdressById($id){
        $val = DB::table('adress')->where('idAdress',$id)->first();
        $adress = new AdressBuilder($val->idAdress, $val->city, $val->postCode, $val->streetNumber, $val->street);
        return $adress;
    }
}
