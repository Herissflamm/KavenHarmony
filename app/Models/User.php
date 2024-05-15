<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone',
        'email',
        'password',
        'id_address',
        'id_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Address::class, "id");
    }

    public function image()
    {
        return $this->hasOne(Image::class, "id");
    }

    public function address()
    {
        return $this->hasOne(Address::class, "id");
    }

    public function hasImage()
    {
        return $this->belongsTo(Image::class, "id");
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, "id");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "id");
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, "id");
    }
    
}
