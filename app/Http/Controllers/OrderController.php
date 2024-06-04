<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateInstrumentHasOrder;
use App\Actions\Order\CreateIsRenting;
use App\Actions\Order\CreateNewOrder;
use App\Actions\Order\UpdateOrder;
use App\Repositories\UsersRepositories;
use Illuminate\Support\Facades\Auth;
use App\Repositories\InstrumentHasOrderRepositories;
use App\Repositories\InstrumentRepositories;
use App\Repositories\OrderRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
    public function addToBasket(Request $request){
        $userId = Auth::id();
        $orderStorage = new CreateNewOrder();
        $orderOpen = OrderRepositories::getLastOpenOrderOfUser($userId);
        $instrument = InstrumentRepositories::getInstrumentByID($request->id);
        $instrumentId = $instrument->id;
        $price = $instrument->sell->price;
        if($orderOpen == null){
            
            $order = $orderStorage->create($price, $userId);
            $orderId = $order->id;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
            
        }else{
            $orderStorage = new UpdateOrder();
            $orderId = $orderOpen->id;
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);
            $orderStorage->updatePrice($orderOpen, $instrument->sell->price);
        }
        return redirect()->route('myBasket', ['orderId' => $orderId]);
    }

    public function addToBasketRent(Request $request){
        $userId = Auth::id();
        $orderOpen = OrderRepositories::getLastOpenOrderOfUser($userId);
        $instrument = InstrumentRepositories::getInstrumentByID($request["instrument"]);
        $instrumentId = $instrument->id;
        $price = $instrument->rent->price;
        $date = $instrument->rent->duration_max;
        if($orderOpen == null){
            $rentingStorge = new CreateIsRenting();
            $rentingStorge->create($date, $userId, $instrumentId);
            $orderStorage = new CreateNewOrder();
            $order = $orderStorage->create($price, $userId);
            $orderId = $order->id; 
            $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
            $instrumentHasOrderStorage->create($instrumentId, $orderId);           
        }else{
            $isRent = false;
            foreach($orderOpen->instrument as $product){
                if($product->sell == null){
                    $isRent = true;
                }
            }
            if($isRent){
                $orderId = $orderOpen->id;
                $instrumentHasOrderStorage = new CreateInstrumentHasOrder();
                $instrumentHasOrderStorage->create($instrumentId, $orderId);
            }else{
                return Redirect::back()->withErrors(['msg' => 'Veuillez vider votre panier ou le valider avant de louer un nouveau produit']);
            }
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
        InstrumentHasOrderRepositories::deleteInstrumentFromOrder($request->id_instrument, $request->id_order);
        $order = OrderRepositories::getOrderById($request->id_order);
        $instrument = InstrumentRepositories::getInstrumentByID($request->id_instrument);
        if($instrument->rent != null){
            $price = $instrument->sell->price;
        }else{
            $price = $instrument->sell->price;
        }
        $updateOrder = new UpdateOrder();
        $updateOrder->updatePrice($order,-$price);
        return $instrument;
    }

    public function validateOrder(Request $request){
        $orderUpdate = new UpdateOrder();
        $order = OrderRepositories::getOrderbyId($request->id);
        $orderUpdate->update($order);
        $instruments = InstrumentRepositories::getAllInstrumentByOrderId($order->id);
        $seller = UsersRepositories::getDistinctSellerFromOrder($order->id);
        return view('account/validateBasket', ['order' => $order, 'instruments' => $instruments, 'sellers' => $seller]);
    }
}
