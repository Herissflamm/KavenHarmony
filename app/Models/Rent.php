<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'rent';

    protected $fillable = [
        'price',
        'duration_max',
        'id_frequency',
        'id_discount'
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id", "id_rent");
    }

    public function frequency()
    {
        return $this->hasOne(Frequency::class, "id", "id_frequency");
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, "id", "id_discount");
    }

}
