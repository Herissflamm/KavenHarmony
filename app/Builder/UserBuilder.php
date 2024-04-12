<?php

namespace App\Builder;

use App\Models\Adress;

class UserBuilder
{

    private int $id;
    private String $firstName;
    private String $lastName;
    private String $username;
    private String $phone;
    private String $email;
    private String $password;
    private AdressBuilder $address;


    public function __construct(int $id, String $firstName, String $lastName, String $username, String $phone, String $email, String $password, AdressBuilder $address){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getFirstName(){
        return $this->firstName;
    }
}
