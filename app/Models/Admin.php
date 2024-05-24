<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_users';
    public $table = 'admin';
    protected $fillable = [
        'id_users'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, "id", "id_users");
    }
}
