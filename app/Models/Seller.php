<?php

namespace App\Models;

class Seller extends User
{

    protected $primaryKey = 'id_users';
    public $table = 'seller';
    protected $fillable = [
      'id_users',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id_seller");
    }
    public function users()
    {
        return $this->hasOne(User::class, "id");
    }

    
}
