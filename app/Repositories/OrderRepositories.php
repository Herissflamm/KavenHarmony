<?php
 
 namespace App\Repositories;
  
 use App\Models\Order;
 use Illuminate\Support\Facades\DB;
 
 class OrderRepositories{
   
  public static function getOrderById($orderId){
    $orders = Order::select('order.*')->with('instrument', 'status')
    ->where('id', $orderId)->get()->first();
    return $orders;
  }
  public static function getOrderByUserId($userId){
    $orders = Order::select('order.*')->with('instrument', 'status')
    ->where('id_customer', $userId)
    ->get();
    return $orders;
  }

  public static function getBasket($userId){
    $orders = Order::select('order.*')->with('instrument', 'status')
    ->where('id_customer', $userId)
    ->where('id_status', 3)->get();
    return $orders;
  }
  
  public static function getLastOpenOrderOfUser($idUser){
    $order = Order::select('order.*')->with('instrument', 'status')
    ->join('order_status', 'order_status.id', '=', 'order.id_status')
    ->where('order_status.status', '=', 'Panier')
    ->where('order.id_customer','=',$idUser)
    ->get()
    ->first();
    return $order;
  }
  
 }