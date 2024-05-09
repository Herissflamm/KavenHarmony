<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'discount';
    protected $fillable = [
      'price',
    ];

    public function rent()
    {
        return $this->belongsTo(Rent::class, "id");
    }

    public function sell()
    {
        return $this->belongsTo(Sell::class, "id");
    }
}
