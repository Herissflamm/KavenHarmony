<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateInstrumentHasOrder;
use App\Actions\Order\CreateNewOrder;
use Illuminate\Support\Facades\Auth;
use App\Repositories\InstrumentHasOrderRepositories;
use App\Repositories\InstrumentRepositories;
use App\Repositories\OrderRepositories;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addToBasket(Request $request){
        $userId = Auth::id();
        $orderOpen = OrderRepositories::getLastOpenOrderOfUser($userId);
        $instrument = InstrumentRepositories::getInstrumentByID($request->id);
        $instrumentId = $instrument->id;
        if($orderOpen == null){
            dd($orderOpen);
            $orderStorage = new CreateNewOrder();
            $order = $orderStorage->create($request->input(), $userId);
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
        $instruments = OrderRepositories::getOrderByUserId($userId)->first();
        return view('account/myBasket', ['instruments' => $instruments]);
    }

    public function getAllOrders(Request $request){
        $userId = Auth::id();
        $orders = OrderRepositories::getOrderByUserId($userId);
        $instruments =[];
        foreach($orders as $order){
            $instruments[] = InstrumentRepositories::getInstrumentByOrderId($order->idOrder);
        }
        return view('account/boughtProduct', ['instruments' => $instruments]);
    }

    public function deleteInstrumentFromOrder(Request $request){
        InstrumentHasOrderRepositories::deleteInstrumentFromOrder($request->id);
        return $request->id;
    }
}
