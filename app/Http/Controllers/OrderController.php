<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateInstrumentHasOrder;
use App\Actions\Order\CreateNewOrder;
use App\Models\InstrumentHasOrder;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addToBasket(Request $request){
        $userController = new UserController();
        $userId = $userController->getIdUserConnected($request);
        $orderOpen = Order::getLastOpenOrderOfUser($userId);
        $instrument = Instrument::getInstrumentByID($request->id);
        $instrumentId = $instrument->getId();
        if($orderOpen == null){
            $orderStorage = new CreateNewOrder();
            $order = $orderStorage->create($request->input(), $userId);
            $orderId = $order->idOrder;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
            
        }else{
            $orderId = $orderOpen->idOrder;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
        }
        return redirect()->route('myBasket', ['orderId' => $orderId]);
    }

    public function getMyBasket(Request $request){
        $userController = new UserController();
        $userId = $userController->getIdUserConnected($request);
        $instruments = InstrumentHasOrder::getAllInstrumentOfOrderByUserId($userId);
        return view('account/myBasket', ['instruments' => $instruments]);
    }

    public function getAllOrders(Request $request){
        $userController = new UserController();
        $userId = $userController->getIdUserConnected($request);
        $orders = DB::table('order')->get()->where('Customer_User_idUser', $userId);
        $instruments =[];
        foreach($orders as $order){
            $instruments[] = Instrument::getInstrumentByOrderId($order->idOrder);
        }
        return view('account/boughtProduct', ['instruments' => $instruments]);
    }

    public function deleteInstrumentFromOrder(Request $request){
        InstrumentHasOrder::deleteInstrumentFromOrder($request->id);
        return $request->id;
    }
}
