<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'image';
    protected $fillable = [
        'path',
        'id_user'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, "id_users");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id");
    }

    public function instrument()
    {
        return $this->belongsToMany(Instrument::class, 'instrument_has_image', 'id_image', 'id_instrument')->using(InstrumentHasImage::class);
    }

    public function instrument_has_image()
    {
        return $this->hasMany(InstrumentHasImage::class, 'id_image');
    }

}
