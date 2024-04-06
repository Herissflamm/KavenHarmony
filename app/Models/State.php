<?php

namespace App\Models;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $primaryKey = 'idState';
    public $table = 'state';
    public $timestamps = false;

    protected $fillable = [
        'state',
    ];

    public function profile()
    {
        return $this->belongsTo(Instrument::class, "idState");
    }
}
