<?php

namespace App\Builder;

class AddressBuilder
{

    private int $id;
    private String $city;
    private String $postCode;
    private String $streetNumber;
    private String $street;


    public function __construct(int $id, String $city, String $postCode, String $streetNumber, String $street){
        $this->id = $id;
        $this->city = $city;
        $this->postCode = $postCode;
        $this->streetNumber = $streetNumber;
        $this->street = $street;
    }

}
