<?php

namespace App\Builder;

class ImageBuilder
{

  private String $path;
  private String $id;
  private UserBuilder $user;

  public function __construct(Int $id, String $path, UserBuilder $userBuilder){
      $this->id = $id;
      $this->path = $path;
      $this->user = $userBuilder;
  }
  public function getId(){
    return $this->id;
  }
  public function getPath(){
    return $this->path;
  }

  public function getUser(){
    return $this->user;
  }

}
