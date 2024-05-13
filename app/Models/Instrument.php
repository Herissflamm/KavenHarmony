<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Instrument extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $table = 'instrument';
    protected $fillable = [
        'name',
        'description',
        'id_type_instrument',
        'id_seller',
        'id_state',
        'id_sell',
        'id_rent'
    ];

    public function image()
    {
        return $this->belongsToMany(Image::class, 'instrument_has_image', 'id_instrument', 'id_image')->using(InstrumentHasImage::class);
    }

    public function instrument_has_image()
    {
        return $this->hasMany(InstrumentHasImage::class, 'id_instrument');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'instrument_has_order', 'id_instrument', 'id_order')->using(InstrumentHasOrder::class);
    }

    public function instrument_has_order()
    {
        return $this->hasMany(InstrumentHasOrder::class, 'id_instrument');
    }

    public function rent()
    {
        return $this->hasOne(Rent::class, "id");
    }

    public function sell()
    {
        return $this->hasOne(Sell::class, "id");
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, "id_users");
    }

    public function state()
    {
        return $this->hasOne(State::class, "id");
    }

    public function type_instrument()
    {
        return $this->hasOne(Type::class, "id");
    }

    public static function getAllInstrument(){
        return self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->get()->first();       
    }

    public static function getAllInstrumentWithoutOrder(){
        $instrumentQuery = self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
        ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
        ->whereNull('instrument_has_order.id_instrument')
        ->get();
        return $instrumentQuery;
    }
    public static function getInstrumentByID($id){
        $instrumentQuery = self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->where('id', $id)->first();
        return $instrumentQuery;
    }

    public static function getInstrumentsByFilter($state, $type, $minPrice, $maxPrice){
        $stateId = null;
        $typeId = null;
        if($state != null){
            $stateFilter = State::getStateByStateName($state);
            $stateId = $stateFilter->id;
        }
        if($type != null){
            $typeFilter = Type::getTypeByTypeName($type);
            $typeId = $typeFilter->id;
        }
        $instrumentQuery = self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')->join('sell', 'sell.id', '=', 'instrument.id_sell' );
        $instrumentQuery = $instrumentQuery->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id');
        $instrumentQuery = $instrumentQuery->whereNull('instrument_has_order.id_instrument');
        if($typeId != null ){      
            $instrumentQuery = $instrumentQuery->where('id_type_instrument', $typeId);
        }
        if($stateId != null){
            $instrumentQuery = $instrumentQuery->where('id_state', $stateId);
        }
        if($minPrice != null && $maxPrice != null){
            $instrumentQuery = $instrumentQuery->where('sell.price', '>=', $minPrice)->where('sell.price', '<=', $maxPrice);
        }
        $instrumentQuery = $instrumentQuery->get();
        
        return $instrumentQuery;
    }


    public static function getAllInstrumentWithSearch($value){ 
        $allInstrument= [];
        $instrumentQuery = null;
        $instrumentQuery = self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
            ->join('type_instrument', 'instrument.id_type_instrument', '=', 'type_instrument.id')
            ->join('state', 'instrument.id_state', '=', 'state.id')
            ->leftJoin('instrument_has_order', 'instrument_has_order.id_instrument', '=', 'instrument.id')
            ->whereNull('instrument_has_order.id_instrument')
            ->whereAny([
                'type_instrument.type',
                'state.state',
                'instrument.name',
            ], 'LIKE', '%'.$value.'%')
            ->get();
        return $instrumentQuery;
    }

    public static function getInstrumentBySeller($id){
        $instrumentQuery = self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
        ->where('id_seller', '=', $id)->get();
        return $instrumentQuery;
    }
    
    public static function getInstrumentByOrderId($id){
        $instrumentQuery = self::with('state', 'type_instrument', 'seller', 'sell', 'rent', 'image', 'order')
        ->join('instrument_has_order', 'instrument_has_order.Instrument_idInstrument', '=', 'instrument.idInstrument')
        ->where('instrument_has_order.Order_idOrder', '=', $id)
        ->get()
        ->first();
        return $instrumentQuery;
    }
}
