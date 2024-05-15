<?php
 
namespace App\Repositories;
 
use App\Models\Seller;
 
class SellerRepositories{
  public static function getSellerByID($id){
    $val =  Seller::with('user')->where('id_users', $id)->first();
    return $val; 
  }
}