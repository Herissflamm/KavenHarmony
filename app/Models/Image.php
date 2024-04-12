<?php

namespace App\Models;

use App\Builder\ImageBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'idImage';
    public $table = 'image';
    public $timestamps = false;

    protected $fillable = [
        'path',
        'createIdUser'
    ];

    public function profile()
    {
        return $this->belongsTo(Seller::class, "User_idUsers");
    }

    public static function getImageByID($id){
        $val = DB::table('image')->where('idImage', $id)->first();
        $user = User::getUSerByID($val->createIdUser);
        $type = new ImageBuilder($val->idImage, $val->path, $user);
        return $type;
    }
}
