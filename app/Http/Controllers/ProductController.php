<?php

namespace App\Http\Controllers;


use App\Models\Type;
use App\Models\Sell;
use App\Models\State;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showCreate(Request $request){
        $state = DB::table('state')->get();
        $allType = DB::table('type_instrument')->get();
        return view('market/createProduct', ['allState' => $state, 'allType' => $allType]);
    }

    public function showSearch(Request $request){
        $instruments = null;
        if($request->searchValue != null){
            $instruments = Instrument::getAllInstrumentWithSearch($request->searchValue);
        }else{
            $instruments = Instrument::getAllInstrumentWithOutOrder();
        }
        $allState = State::getAllState();
        $allType = Type::getAllType();
        $biggestPrice = 0;
        foreach($instruments as $instrument){
            if($biggestPrice < $instrument->sell->price){
                $biggestPrice = $instrument->sell->price;
            }
        }
        return view('market/listIntrument', ['allState' => $allState, 'allType' => $allType, 'instruments' => $instruments, 'biggestPrice'=>$biggestPrice]);
    }

    public function showProduct(Request $request){
        $instrument = Instrument::getInstrumentByID($request->id);
        return view('market/product', ['instrument' => $instrument]);
    }

    public function showAllMyProduct(Request $request){
        $userController = new UserController();
        $idUser = $userController->getIdUserConnected($request);
        $instrument = Instrument::getInstrumentBySeller($idUser);
        return view('account/soldProduct', ['instruments' => $instrument]);
    }

    public function showAllProductBought(Request $request){
        $userController = new UserController();
        $idUser = $userController->getIdUserConnected($request);
        $instrument = Instrument::getInstrumentBySeller($idUser);
        return view('account/boughtProduct', ['instruments' => $instrument]);
    }

    public function filterProduct(Request $request){
        $instrumentQuery = Instrument::getInstrumentsByFilter($request->state, $request->type, $request->minPrice, $request->maxPrice);
        if($instrumentQuery != null){
            return $instrumentQuery ;
        }else{
            return "";
        }
    }
}
