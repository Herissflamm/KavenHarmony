<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $primaryKey = 'idInstrument';
    public $table = 'instrument';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'idTypeInstrument',
        'idState',
        'SelleridUser',
        'idImage',
        'Sell_idSell',
        'Rent_idRent'
    ];

    public function profile()
    {
        return $this->belongsTo(Seller::class, "User_idUsers");
    }
}
