<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instrument;
use App\Models\Categories;


class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'type_instrument';

    protected $fillable = [
        'type',
        'categories'
    ];
    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id_type_instrument");
    }

    public function categories()
    {
        return $this->hasOne(Categories::class, "id");
    }

}
