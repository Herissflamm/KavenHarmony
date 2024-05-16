<?php
 
namespace App\Repositories;
 
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
 
class CategoriesRepositories
{
  public static function getAllCategories(){
    $categories = Categories::with('type')->get();
    return $categories;
  }

public static function getTypeByID($id){
    $val = Categories::with('type')->where('id', $id)->first();
    return $val;
  }

  public static function getTypeByCategoriesName($categories){
      $val = Categories::with('type')->where('categories', $categories)->first();
      return $val;
  }
}