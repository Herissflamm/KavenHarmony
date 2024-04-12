<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Adress;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255'],
            'firstName' => ['required', 'string', 'max:32'],
            'lastName' => ['required', 'string', 'max:32'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'city'=> ['required', 'string', 'max:45'],
            'postCode'=> ['required', 'string', 'max:5'],
            'streetNumber'=> ['required', 'int'],
            'street'=> ['required', 'string', 'max:256'],
            'password' => $this->passwordRules(),
        ])->validate();
        
        
        $adress = Adress::create([
            'city' => $input['city'],
            'postCode' => $input['postCode'],
            'streetNumber' => $input['streetNumber'],
            'street' => $input['street'],
        ]);
        $user = User::create([
            'username' => $input['username'],
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'Adress_idAdress' =>  $adress -> idAdress,
        ]);

        
        if($input['seller']){
            $seller = Seller::create([
                'User_idUsers' =>  $user -> idUsers,
            ]);
        }
        
        if($input['customer']){
            $customer = Customer::create([
                'User_idUsers' =>  $user -> idUsers,
            ]);
        }
        
        return $user;
    }
}
