<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateInstrumentHasOrder;
use App\Actions\Order\CreateNewOrder;
use Illuminate\Support\Facades\Auth;
use App\Repositories\InstrumentHasOrderRepositories;
use App\Repositories\InstrumentRepositories;
use App\Repositories\OrderRepositories;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function addToBasket(Request $request){
        $userId = Auth::id();
        $orderOpen = OrderRepositories::getLastOpenOrderOfUser($userId);
        $instrument = InstrumentRepositories::getInstrumentByID($request->id);
        $instrumentId = $instrument->id;
        $price = $instrument->sell->price;
        if($orderOpen == null){
            $orderStorage = new CreateNewOrder();
            $order = $orderStorage->create($price, $userId);
            $orderId = $order->id;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
            
        }else{
            $orderId = $orderOpen->id;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
        }
        return redirect()->route('myBasket', ['orderId' => $orderId]);
    }

    public function getMyBasket(Request $request){
        $userId = Auth::id();
        $order = OrderRepositories::getBasket($userId)->first();
        return view('account/myBasket', ['order' => $order]);
    }

    public function getOrder(Request $request){
        $orderId = $request['id'];
        $order = OrderRepositories::getOrderbyId($orderId);
        return view('account/myBasket', ['order' => $order]);
    }

    public function getAllOrders(Request $request){
        $userId = Auth::id();
        $orders = OrderRepositories::getOrderByUserId($userId);
        return view('account/boughtProduct', ['orders' => $orders]);
    }

    public function deleteInstrumentFromOrder(Request $request){
        InstrumentHasOrderRepositories::deleteInstrumentFromOrder($request->id);
        return $request->id;
    }
}
