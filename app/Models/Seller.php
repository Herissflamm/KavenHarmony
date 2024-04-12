<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Seller extends User
{

    protected $primaryKey = 'User_idUsers';
    public $table = 'seller';
    public $timestamps = false;

    protected $fillable = [
      'User_idUsers',
    ];

    public function profile()
    {
        return $this->hasOne(User::class, "idUsers");
    }

    public static function getSellerByID($id){
      $val = DB::table('seller')->where('User_idUsers', $id)->first();
      $userVal = User::getUserById($val->User_idUsers);
      return $userVal; 
    }
}
