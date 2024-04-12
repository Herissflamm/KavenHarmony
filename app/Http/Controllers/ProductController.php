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
        $allInstruments = Instrument::getAllInstrument();
        $allState = State::getAllState();
        $allType = Type::getAllType();
        return view('market/listIntrument', ['allState' => $allState, 'allType' => $allType, 'instruments' => $allInstruments]);
    }

    public function showProduct(Request $request){
        $instrument = Instrument::getInstrumentByID($request->id);
        return view('market/product', ['instrument' => $instrument]);
    }
}
