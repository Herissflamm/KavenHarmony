<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAdress';
    public $table = 'adress';
    public $timestamps = false;

    protected $fillable = [
        'city',
        'postCode',
        'streetNumber',
        'street',
    ];

    public function profile()
    {
        return $this->belongsTo(User::class, "idAdress");
    }
}
