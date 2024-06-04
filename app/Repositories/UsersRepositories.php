<?php
 
namespace App\Repositories;
 
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
class UsersRepositories{
  public static function getUserByID($id){
    $val = User::with('address')->where('id', $id)->first();
    return $val;
  }

  public static function getDistinctSellerFromOrder($id){
    $val = User::select('users.first_name', 'users.last_name', 'users.phone', 'users.email')->distinct()->with('address')
    ->join('seller', 'seller.id_users', '=', 'users.id')
    ->join('instrument', 'instrument.id_seller', '=', 'seller.id_users')
    ->join('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
    ->join('order', 'order.id', '=', 'instrument_has_order.id_order')
    ->where('order.id', '=', $id)->get();
    return $val;
  }
}