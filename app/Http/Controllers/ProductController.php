<?php

namespace App\Http\Controllers;


use App\Actions\Product\UpdateProduct;
use App\Actions\Product\UpdateRent;
use App\Actions\Product\UpdateSell;
use App\Repositories\CategoriesRepositories;
use App\Repositories\InstrumentRepositories;
use App\Repositories\TypeRepositories;
use App\Repositories\StateRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function showCreate(Request $request){
        $state = StateRepositories::getAllState();
        $allType = TypeRepositories::getAllType();
        return view('market/createProduct', ['allState' => $state, 'allType' => $allType]);
    }

    public function showSearch(Request $request){
        $instruments = null;
        if($request->searchValue != null){
            $instruments = InstrumentRepositories::getAllInstrumentWithSearch($request->searchValue);
        }else{
            $instruments = InstrumentRepositories::getAllInstrumentWithOutOrder();
        }
        $allState = StateRepositories::getAllState();
        $allCategories = CategoriesRepositories::getAllCategories();
        $allType = TypeRepositories::getAllType();
        $biggestPrice = 0;
        foreach($instruments as $instrument){
            if($biggestPrice < $instrument->sell->price){
                $biggestPrice = $instrument->sell->price;
            }
        }
        $user = Auth::user();
        $customer = null;
        if($user != null){
            $customer = $user->customer;
        }
        return view('market/listIntrument', ['customer' => $user->customer, 'allState' => $allState, 'instruments' => $instruments, 'biggestPrice'=>$biggestPrice, 'allCategories'=>$allCategories, 'allType'=>$allType]);
    }

    public function showProduct(Request $request){
        $instrument = InstrumentRepositories::getInstrumentByID($request->id);
        $suggestInstrument = InstrumentRepositories::getInstrumentSuggest($instrument->type_instrument->id, $instrument->seller->id_users, $instrument->id);
        return view('market/product', ['instrument' => $instrument, 'suggestInstrument' => $suggestInstrument]);
    }

    public function showAllMyProduct(Request $request){
        $userId = Auth::id();
        $instrument = InstrumentRepositories::getInstrumentBySeller($userId);
        return view('account/soldProduct', ['instruments' => $instrument]);
    }

    public function showAllProductBought(Request $request){
        $userId = Auth::id();
        $instrument = InstrumentRepositories::getInstrumentBySeller($userId);
        return view('account/boughtProduct', ['instruments' => $instrument]);
    }

    public function filterProduct(Request $request){
        $instrumentQuery = InstrumentRepositories::getInstrumentsByFilter($request->state, $request->type, $request->minPrice, $request->maxPrice);
        if($instrumentQuery != null){
            return $instrumentQuery ;
        }else{
            return "";
        }
    }
    public function showModifyProduct(Request $request){
        $state = StateRepositories::getAllState();
        $allType = TypeRepositories::getAllType();
        $instrument = InstrumentRepositories::getInstrumentByID($request["instrument"]);
        return view('market/modifyProduct', ['allState' => $state, 'allType' => $allType,'instrument' => $instrument]);
    }

    //Modifie un produit et affiche sa page
    public function modifyProduct(Request $request){
        $instrument = InstrumentRepositories::getInstrumentByID($request['id']);
        $id_type = TypeRepositories::getTypeByTypeName($request['instrumentType'])->id;
        $id_state = StateRepositories::getStateByStateName($request['state'])->id;
        $sell = $instrument->sell;
        $rent = $instrument->rent;
        if($sell != null){
            $updateSell = new UpdateSell();
            $updateSell->update($request, $sell);
        }
        if($rent != null){
            $updateRent = new UpdateRent();
            $updateRent->update($request, $rent);
        }
        $updateProduct = new UpdateProduct();
        $instrument = $updateProduct->update($request, $instrument, $id_state, $id_type);
        $suggestInstrument = InstrumentRepositories::getInstrumentSuggest($instrument->type_instrument->id,
        $instrument->seller->id_users, $instrument->id);
        return view('market/product', ['instrument' => $instrument, 'suggestInstrument' => $suggestInstrument]); 
    }
}
