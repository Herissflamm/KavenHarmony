<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Builder\UserBuilder;
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

    protected $primaryKey = 'idUsers';
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'phone',
        'email',
        'password',
        'Adress_idAdress'
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
    
    public static function getUSerByID($id){
        $val = DB::table('users')->where('idUsers', $id)->first();
        $adress = Adress::getAdressById($val->Adress_idAdress);
        $user = new UserBuilder($val->idUsers , $val->firstName, $val->lastName, $val->username, $val->phone, $val->email, $val->password, $adress);
        return $user;
      }
    public function profile()
    {
        return $this->hasOne(Adress::class, "idAdress");
    }
}
