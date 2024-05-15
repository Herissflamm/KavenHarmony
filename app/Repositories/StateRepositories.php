<?php
 
namespace App\Repositories;
 
use Illuminate\Support\Facades\DB;
 
class StateRepositories{
  public static function getAllState(){
    $stateQuery =DB::table('state')->get();
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
}