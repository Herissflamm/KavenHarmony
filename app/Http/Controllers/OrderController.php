<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateInstrumentHasOrder;
use App\Actions\Order\CreateNewOrder;
use App\Models\InstrumentHasOrder;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\Order;
class OrderController extends Controller
{
    public function addToBasket(Request $request){
        $orderOpen = Order::getLastOpenOrder();
        $instrument = Instrument::getInstrumentByID($request->id);
        $instrumentId = $instrument->getId();
        $userController = new UserController();
        $userId = $userController->getIdUserConnected($request);
        if($orderOpen == null){
            $orderStorage = new CreateNewOrder();
            $order = $orderStorage->create($request->input(), $userId);
            $orderId = $order->idOrder;
            
        }else{
            $orderId = $orderOpen->idOrder;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
        }
        return redirect()->route('myBasket', ['orderId' => $orderId]);
    }

    public function getMyBasket(Request $request){
        $instruments = InstrumentHasOrder::getAllInstrumentByOrderId($request->orderId); 
        return view('account/myBasket', ['instruments' => $instruments]);
    }
}
