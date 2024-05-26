<?php
 
namespace App\Repositories;
 
use App\Models\Image;
 
class ImageRepositories{
  public static function getImageByID($id){
    $val = Image::select('image.*')->with('user')->where('id', $id)->first();
    return $val;
  }
}