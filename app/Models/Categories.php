<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'categories';

    protected $fillable = [
        'categories'
    ];
    public function type()
    {
        return $this->belongsTo(Type::class, "id");
    }

}
