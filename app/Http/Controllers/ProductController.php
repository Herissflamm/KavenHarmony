<?php

namespace App\Http\Controllers;


use App\Models\Type;
use App\Models\State;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showCreate(Request $request){
        $state = DB::table('state')->get();
        $allType = DB::table('typeinstrument')->get();
        return view('market/createProduct', ['allState' => $state, 'allType' => $allType]);
    }

    public function showSearch(Request $request){
        $instrument = null;
        if($request->searchValue != null){
            $instrument = Instrument::getAllInstrumentWithSearch($request->searchValue);
        }else{
            $instrument = Instrument::getAllInstrument();
        }
        $allState = State::getAllState();
        $allType = Type::getAllType();
        return view('market/listIntrument', ['allState' => $allState, 'allType' => $allType, 'instruments' => $instrument]);
    }

    public function showProduct(Request $request){
        $instrument = Instrument::getInstrumentByID($request->id);
        return view('market/product', ['instrument' => $instrument]);
    }

    public function filterProduct(Request $request){
        $instrumentQuery = Instrument::getInstrumentsByFilter($request->state, $request->type);
        $allInstruments = [];
        foreach ($instrumentQuery as $instrument)
        {
            if( $instrument->getImage() === null){
                $allInstruments[] = [
                    'type' => $instrument->getType()->getType(),
                    'state' => $instrument->getState()->getState(),
                    'price' => $instrument->getSell()->getPrice(),
                    'description' => $instrument->getDescription(),
                    'id' => $instrument->getId(),
                    'image' => null,
                ];
            }else{
                $allInstruments[] = [
                    'type' => $instrument->getType()->getType(),
                    'state' => $instrument->getState()->getState(),
                    'price' => $instrument->getSell()->getPrice(),
                    'description' => $instrument->getDescription(),
                    'id' => $instrument->getId(),
                    'image' => $instrument->getImage()[0]->getPath(),
                ];
            }
        }
        if($instrumentQuery != null){
            return $allInstruments;
        }else{
            return "";
        }
    }
}
