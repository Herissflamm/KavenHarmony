<?php

namespace App\Builder;

class TypeBuilder
{

  private String $type;
  private String $id;

  public function __construct(Int $id, String $type){
      $this->id = $id;
      $this->type = $type;
  }

  public function getId(){
    return $this->id;
  }

  public function getType(){
    return $this->type;
  }
}
