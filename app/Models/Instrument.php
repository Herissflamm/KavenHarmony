<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'instrument';
    protected $fillable = [
        'name',
        'description',
        'id_type_instrument',
        'id_seller',
        'id_state',
        'id_sell',
        'id_rent'
    ];

    public function image()
    {
        return $this->belongsToMany(Image::class, 'instrument_has_image', 'id_instrument', 'id_image')->using(InstrumentHasImage::class);
    }

    public function instrument_has_image()
    {
        return $this->hasMany(InstrumentHasImage::class, 'id_instrument', 'id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'instrument_has_order', 'id_instrument', 'id_order')->using(InstrumentHasOrder::class);
    }

    public function instrument_has_order()
    {
        return $this->hasMany(InstrumentHasOrder::class, 'id_instrument', 'id');
    }

    public function rent()
    {
        return $this->hasOne(Rent::class, "id", "id_rent");
    }

    public function sell()
    {
        return $this->hasOne(Sell::class, "id", "id_sell");
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, "id_users", "id_seller");
    }

    public function state()
    {
        return $this->hasOne(State::class, "id", "id_state");
    }

    public function type_instrument()
    {
        return $this->hasOne(Type::class, "id", "id_type_instrument");
    }

}
