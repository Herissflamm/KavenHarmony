<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsRenting extends Model
{
    use HasFactory;

    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'is_renting';

    protected $fillable = [
        'date_start',
        'date_end',
        'id_customer',
        'id_instrument'
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, "id", "id_rent");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "id", "id_customer");
    }
}
