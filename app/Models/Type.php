<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'type_instrument';

    protected $fillable = [
        'type',
    ];
    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id_type_instrument");
    }

}
