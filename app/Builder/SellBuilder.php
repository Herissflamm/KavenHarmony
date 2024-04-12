<?php

namespace App\Builder;

class SellBuilder
{

  private String $price;
  private String $id;

  public function __construct(Int $id, String $price){
      $this->id = $id;
      $this->price = $price;
  }
  public function getPrice(){
    return $this->price;
  }

  public function getId(){
    return $this->id;
  }


}