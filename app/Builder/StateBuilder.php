<?php

namespace App\Builder;

class StateBuilder
{

  private String $state;
  private String $id;

  public function __construct(Int $id, String $state){
      $this->id = $id;
      $this->state = $state;
  }
  public function getState(){
    return $this->state;
  }

  public function getId(){
    return $this->id;
  }


}