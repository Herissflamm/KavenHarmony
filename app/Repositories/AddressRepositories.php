<?php
 
namespace App\Repositories;
 
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
class AddressRepositories{
  
  public static function getAddressById($id){
    $val = DB::table('address')->where('id',$id)->first();
    return $val;
  }
}