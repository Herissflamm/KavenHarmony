<?php

namespace App\Http\Controllers;

use App\Actions\User\ModifyUser;
use App\Repositories\AddressRepositories;
use App\Repositories\UsersRepositories;
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

    public function modifyAccount(Request $request){
        $modifyUser = new ModifyUser();
        $user = $request->user();
        $address = $user->address;
        $image = null;
        if($request["images"] != null){
            $image = $user->image;
        }
        $user = $modifyUser->update($request, $address, $user, $image);
        return view('account/myAccount', ['user' => $user]);
    }
}
