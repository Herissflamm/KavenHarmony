<?php

namespace App\Http\Controllers;


use App\Actions\Product\CreateNewRent;
use App\Actions\Product\UpdateProduct;
use App\Actions\Product\UpdateRent;
use App\Actions\Product\UpdateSell;
use App\Repositories\CategoriesRepositories;
use App\Repositories\FrequencyRepositories;
use App\Repositories\InstrumentRepositories;
use App\Repositories\TypeRepositories;
use App\Repositories\StateRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use \Validator;
use App\Actions\Image\CreateNewImage;
use App\Actions\Image\CreateInstrumentHasImage;
use App\Actions\Product\CreateNewSell;
use App\Actions\Product\CreateNewProduct;



class ProductController extends Controller
{
    public function showCreate(Request $request){
        $frequencies = FrequencyRepositories::getAllFrequency();
        $state = StateRepositories::getAllState();
        $allType = TypeRepositories::getAllType();
        return view('market/createProduct', ['allState' => $state, 'allType' => $allType, 'frequencies' => $frequencies]);
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
            if($instrument->sell != null){
                if($biggestPrice < $instrument->sell->price){
                    $biggestPrice = $instrument->sell->price;
                }
            }else{
                if($biggestPrice < $instrument->rent->price){
                    $biggestPrice = $instrument->rent->price;
                }
            }
            
        }
        $user = Auth::user();
        $customer = null;
        if($user != null){
            $customer = $user->customer;
        }
        return view('market/listIntrument', ['customer' => $customer, 'allState' => $allState, 'instruments' => $instruments, 'biggestPrice'=>$biggestPrice, 'allCategories'=>$allCategories, 'allType'=>$allType]);
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
        $instrumentQuery = InstrumentRepositories::getInstrumentsByFilter($request->state, $request->type, 
        $request->minPrice, $request->maxPrice, $request->rentSearch, $request->sellSearch);

        if($instrumentQuery != null){
            return $instrumentQuery ;
        }else{
            return "";
        }
    }
    public function showModifyProduct(Request $request){
        $frequencies = FrequencyRepositories::getAllFrequency();
        $state = StateRepositories::getAllState();
        $allType = TypeRepositories::getAllType();
        $instrument = InstrumentRepositories::getInstrumentByID($request["instrument"]);
        return view('market/modifyProduct', ['allState' => $state, 'allType' => $allType,'instrument' => $instrument, 'frequencies' => $frequencies]);
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
            $id_frequency = FrequencyRepositories::getFrequencyByName($request['frequency'])->id;
            $updateRent = new UpdateRent();
            $updateRent->update($request, $rent, $id_frequency);
        }
        $updateProduct = new UpdateProduct();
        $instrument = $updateProduct->update($request, $instrument, $id_state, $id_type);
        $suggestInstrument = InstrumentRepositories::getInstrumentSuggest($instrument->type_instrument->id,
        $instrument->seller->id_users, $instrument->id);
        return view('market/product', ['instrument' => $instrument, 'suggestInstrument' => $suggestInstrument]); 
    }

    public function createNewProduct(Request $request)
    {       
        $storageSell = new CreateNewSell();
        $storageProduct = new CreateNewProduct();
        $userId = Auth::id();        

        $input = $request->input();
        $sell = $storageSell->create($input);
        $idSell = $sell->id;
        $idTypeInstrument = TypeRepositories::getTypeByTypeName($input['instrumentType'])->id;
        $idState  = StateRepositories::getStateByStateName($input['state'])->id;
        if($idTypeInstrument != null && $idState != null){
            $storageProduct ->create($request, $idTypeInstrument, $idState, $userId, $idSell, null)->id;
        }

        return redirect('search'); 
    }

    public function createNewProductLocation(Request $request)
    {       
        $storageRent = new CreateNewRent();
        $storageProduct = new CreateNewProduct();
        $userId = Auth::id();

        $id_frequency = FrequencyRepositories::getFrequencyByName($request['frequency'])->id;
        $input = $request->input();
        $rent = $storageRent->create($input, $id_frequency);
        $idRent = $rent->id;
        $idTypeInstrument = TypeRepositories::getTypeByTypeName($input['instrumentType'])->id;
        $idState  = StateRepositories::getStateByStateName($input['state'])->id;
        if($idTypeInstrument != null && $idState != null){
            $storageProduct ->create($request, $idTypeInstrument, $idState, $userId, null, $idRent)->id;
        }

        return redirect('search'); 
    }
    
}
