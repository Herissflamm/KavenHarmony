<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTypeInstrument';
    public $table = 'typeInstrument';
    public $timestamps = false;

    protected $fillable = [
        'type',
    ];

    public function profile()
    {
        return $this->belongsTo(Instrument::class, "idTypeInstrument");
    }
}
