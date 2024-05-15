<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Address;
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
            'first_name' => ['required', 'string', 'max:32'],
            'last_name' => ['required', 'string', 'max:32'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'city'=> ['required', 'string', 'max:45'],
            'post_code'=> ['required', 'string', 'max:5'],
            'street_number'=> ['required', 'int'],
            'street_name'=> ['required', 'string', 'max:256'],
            'password' => $this->passwordRules(),
        ])->validate();
        
        $address = Address::create([
            'city' => $input['city'],
            'post_code' => $input['post_code'],
            'street_number' => $input['street_number'],
            'street_name' => $input['street_name'],
        ]);
        $user = User::create([
            'username' => $input['username'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'id_address' =>  $address -> id,
        ]);
        if(isset($_POST['seller'])){
            Seller::create([
                'id_users' =>  $user -> id,
            ]);
        }
            
        if(isset($_POST['customer'])){
            Customer::create([
                'id_users' =>  $user -> id,
            ]);   
        }
        
        return $user;
    }
}
