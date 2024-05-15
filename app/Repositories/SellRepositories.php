<?php
 
namespace App\Repositories;
 
use Illuminate\Support\Facades\DB;

class SellRepositories{
  
  public static function getSellByID($id){
    $val = DB::table('sell')->where('id', $id)->first();
    return $val;
  }

}