<?php

namespace App\Actions\User;

use App\Models\Image;
use App\Models\User;
use App\Models\Address;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Actions\Fortify\PasswordValidationRules;


class ModifyUser
{
    use PasswordValidationRules;
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function update(Request $request, Address $address, User $user, Image $image=null ) : User
    {
      $input = $request->all();
      if($user->email != $input['email']){
        Validator::make($input, ['email' => [
          'required',
          'string',
          'email',
          'max:255',
          Rule::unique(User::class),
        ]])->validate();
      }
      if(isset($input['password'])){
        Validator::make($input, [
          'username' => ['required', 'string', 'max:255'],
          'first_name' => ['required', 'string', 'max:32'],
          'last_name' => ['required', 'string', 'max:32'],
          'phone' => ['required', 'string', 'max:11'],
          'city'=> ['required', 'string', 'max:45'],
          'post_code'=> ['required', 'string', 'max:5'],
          'street_number'=> ['required', 'int'],
          'street_name'=> ['required', 'string', 'max:256'],
          'current_password' => ['required', 'string', 'current_password:web'],
              'password' => $this->passwordRules(),
          ], [
              'current_password.current_password' => __('The provided password does not match your current password.'),
          ])->validate();

          $user->forceFill([
            'password' => Hash::make($input['password']),
          ])->save();
      }else{
        Validator::make($input, [
          'username' => ['required', 'string', 'max:255'],
          'first_name' => ['required', 'string', 'max:32'],
          'last_name' => ['required', 'string', 'max:32'],
          'phone' => ['required', 'string', 'max:11'],
          'city'=> ['required', 'string', 'max:45'],
          'post_code'=> ['required', 'string', 'max:5'],
          'street_number'=> ['required', 'int'],
          'street_name'=> ['required', 'string', 'max:256'],
          ])->validate();
      }
      
      if(isset($input["images"])){
        if($request["images"] != null){
          $validator = Validator::make(
              $input, [
              'images.*' => 'required|mimes:jpg,jpeg,png,bmp|max:20000'
              ],[
                  'images.*.required' => 'Please upload an image',
                  'images.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                  'images.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
              ]
          );
          if ($validator->fails()) {
              return response()->json(array(
                  'success' => false,
                  'errors' => $validator->getMessageBag()->toArray()
              ) , 400);
          }

          
          $i=0;
          $imageName = $i.time().'.'.$request["images"]->extension();  
          $request["images"]->move(public_path('images'), $imageName);
          if($image == null){
            $image = Image::create([
              'path' => $imageName,
              'id_user' => $user -> id,
            ]);
          }else{
            $image->path = $imageName;
            $image->save();
          }
          $user->id_image = $image->id;      
        }
      }

      $address->city = $input['city'];
      $address->post_code = $input['post_code'];
      $address->street_number = $input['street_number'];
      $address->street_name = $input['street_name'];
      $address->save();


      $user->username = $input['username'];
      $user->first_name = $input['first_name'];
      $user->last_name = $input['last_name'];
      $user->phone = $input['phone'];
      $user->email = $input['email'];
      
      $user->save();             
      return $user;
    }
}
