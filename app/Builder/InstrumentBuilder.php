<?php

namespace App\Builder;

use App\Builder\TypeBuilder;
use App\Builder\StateBuilder;
use App\Builder\UserBuilder;
use App\Builder\ImageBuilder;
use App\Builder\RentBuilder;

class InstrumentBuilder
{
    
  private int $id;
  private String $name;
  private String $description;
  private TypeBuilder $type;
  private StateBuilder $state;
  private UserBuilder $seller;
  private array $image;
  private SellBuilder $sell;

  public function __construct(int $id, string $name, string $description, TypeBuilder $type, StateBuilder $state, UserBuilder $seller, array $image, SellBuilder $sell) {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->type = $type;
      $this->state = $state;
      $this->seller = $seller;
      $this->image = $image;
      $this->sell = $sell;
  }

  public function getId(){
    return $this->id;
  }
  public function getName(){
    return $this->name;
  }

  public function getType(){
    return $this->type;
  }

  public function getState(){
    return $this->state;
  }

  public function getSeller(){
    return $this->seller;
  }

  public function getImage(){
    if(empty($this->image)){
      return null;
    }else{
      return $this->image;
    }
    
  }

  public function getSell(){
    return $this->sell;
  }

  public function getDescription(){
    return $this->description;
  }

}



