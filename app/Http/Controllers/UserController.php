<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showMyAccount(Request $request)
    {
        $user = $request->user();
        return view('account/myAccount', ['user' => $user]);
    }

    public function showModifyAccount(Request $request)
    {
        $user = $request->user();
        return view('account/modifyAccount', ['user' => $user]);
    }

    public function getIdUserConnected(Request $request)
    {
        return Auth::id();
    }
}
