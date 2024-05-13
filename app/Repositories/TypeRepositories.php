<?php
 
namespace App\Repositories;
 
use Illuminate\Support\Facades\DB;
 
class TypeRepositories
{
  public static function getAllType(){
    $typeQuery = DB::table('type_instrument')->get();
    return $typeQuery;
  }

public static function getTypeByID($id){
    $val = DB::table('type_instrument')->where('id', $id)->first();
    return $val;
  }

  public static function getTypeByTypeName($type){
      $val = DB::table('type_instrument')->where('type', $type)->first();
      return $val;
  }
}