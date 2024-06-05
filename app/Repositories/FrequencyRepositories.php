<?php
 
namespace App\Repositories;
 
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
class FrequencyRepositories{
  
  public static function getAllFrequency(){
    $val = DB::table('frequency')->get();
    return $val;
  }

  public static function getFrequencyByName($name){
    $val = DB::table('frequency')->where('frequency', '=', $name)->get()->first();
    return $val;
  }
}