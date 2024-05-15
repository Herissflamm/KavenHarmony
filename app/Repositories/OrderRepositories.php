<?php
 
 namespace App\Repositories;
  
 use Illuminate\Support\Facades\DB;
 
 class OrderRepositories{
   
  public static function getOrderByUserId($userId){
    $orders = DB::table('order')->get()->where('Customer_User_idUser', $userId);
    return $orders;
  }
  public static function getLastOpenOrderOfUser($idUser){
    $order = DB::table('order')
    ->join('order_status', 'order_status.id', '=', 'order.id_status')
    ->where('order_status.status', '=', 'En Cours')
    ->where('order.id_customer','=',$idUser)
    ->get()
    ->first();
    return $order;
  }
 }