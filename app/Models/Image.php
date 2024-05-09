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
    protected $fillable = [
        'path',
        'id_user'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, "id_users");
    }

    public function instrument_has_image()
    {
        return $this->belongsTo(InstrumentHasImage::class, "id");
    }

    public static function getImageByID($id){
        $val = DB::table('image')->where('id', $id)->first();
        $user = User::getUSerByID($val->id_user);
        $type = new ImageBuilder($val->id, $val->path, $user);
        return $type;
    }
}
