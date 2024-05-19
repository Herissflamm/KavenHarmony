<?php

namespace App\Models;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'state';
    protected $fillable = [
        'state',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id");
    }

}
