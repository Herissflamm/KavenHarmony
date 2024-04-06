<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show(Request $request){
        $state = DB::table('state')->get();
        $allType = DB::table('typeinstrument')->get();
        return view('market/createProduct', ['allState' => $state, 'allType' => $allType]);
    }
}
