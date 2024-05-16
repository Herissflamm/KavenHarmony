<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sell extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'sell';

    protected $fillable = [
      'price',
      'id_discount'
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id");
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, "id");
    }
    
}
