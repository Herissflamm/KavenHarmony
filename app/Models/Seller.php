<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Seller extends User
{

    protected $primaryKey = 'id_users';
    public $table = 'seller';
    protected $fillable = [
      'id_users',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id");
    }
    public function users()
    {
        return $this->hasOne(User::class, "id");
    }

    public static function getSellerByID($id){
      $val = DB::table('seller')->where('id_users', $id)->first();
      $userVal = User::getUserById($val->id_users);
      return $userVal; 
    }
}
