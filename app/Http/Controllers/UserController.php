<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user = $request->user();
        return $user->id;
    }
}
