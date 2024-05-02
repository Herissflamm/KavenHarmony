<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'idOrder';
    public $table = 'order';
    public $timestamps = false;

    protected $fillable = [
        'shippingPrice',
        'totalPrice',
        'Customer_User_idUser',
        'OrderStatus_idOrderStatus'
    ];


    public static function getLastOpenOrder(){
        $order = DB::table('order')->join('orderstatus', 'orderstatus.idOrderStatus', '=', 'order.OrderStatus_idOrderStatus')->where('orderstatus.status', '=', 'En Cours')->get()->first();
        return $order;
    }
}
