<?php

namespace App\Builder;

use App\Models\Address;

class UserBuilder
{

    private int $id;
    private String $first_name;
    private String $last_name;
    private String $username;
    private String $phone;
    private String $email;
    private String $password;
    private AddressBuilder $address;


    public function __construct(int $id, String $first_name, String $last_name, String $username, String $phone, String $email, String $password, AddressBuilder $address){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
    }

    public function getlast_name(){
        return $this->last_name;
    }

    public function getfirst_name(){
        return $this->first_name;
    }
}
