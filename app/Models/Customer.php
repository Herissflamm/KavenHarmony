<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_users';
    public $table = 'customer';
    protected $fillable = [
      'id_users',
    ];

    public function profile()
    {
        return $this->hasOne(User::class, "id", "id_users");
    }
}
