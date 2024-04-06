<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{

    protected $primaryKey = 'User_idUsers';
    public $table = 'customer';
    public $timestamps = false;

    protected $fillable = [
      'User_idUsers',
    ];

    public function profile()
    {
        return $this->hasOne(User::class, "idUsers");
    }
}
