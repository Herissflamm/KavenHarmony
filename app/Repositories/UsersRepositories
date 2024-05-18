<?php
 
namespace App\Repositories;
 
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
class UsersRepositories{
  public static function getUserByID($id){
    $val = User::with('address')->where('id', $id)->first();
    return $val;
  }
}