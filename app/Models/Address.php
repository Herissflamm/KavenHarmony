<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'address';
    protected $fillable = [
        'city',
        'post_code',
        'street_number',
        'street_name',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, "id");
    }

}
