<?php

namespace App\Models;

use App\Builder\InstrumentBuilder;
use App\Builder\StateBuilder;
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

    public function instrument_has_image()
    {
        return $this->belongsTo(InstrumentHasImage::class, "id");
    }

    public function instrument_has_order()
    {
        return $this->belongsTo(InstrumentHasOrder::class, "id");
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
        $instrumentQuery = DB::table('instrument')->get();
        $allInstrument= [];
        foreach($instrumentQuery as $instrument){
            $type = Type::getTypeByID($instrument->id);
            $seller = Seller::getSellerByID($instrument->id_seller);
            $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->id);
            $state = State::getStateByID($instrument->id_state);
            $sell = Sell::getSellByID($instrument->id_sell);
            $description = $instrument->description == null ? "" : $instrument->description; 
            $allInstrument[] = new InstrumentBuilder($instrument->id, $instrument->name, $description, $type, $state, $seller, $image, $sell);
        }
        return $allInstrument;
    }

    public static function getInstrumentByID($id){
        $instrumentQuery = DB::table('instrument')->where('id', $id)->first();
        $type = Type::getTypeByID($instrumentQuery->id_type_instrument);
        $seller = Seller::getSellerByID($instrumentQuery->id_seller);
        $image = InstrumentHasImage::getAllImageByInstrumentId($instrumentQuery->id);
        $state = State::getStateByID($instrumentQuery->id_state);
        $sell = Sell::getSellByID($instrumentQuery->id_sell);
        $description = $instrumentQuery->description == null ? "" : $instrumentQuery->description; 
        $instrument = new InstrumentBuilder($instrumentQuery->id, $instrumentQuery->name, $description, $type, $state, $seller, $image, $sell);
        return $instrument;
    }

    public static function getInstrumentsByFilter($state, $type, $minPrice, $maxPrice){
        $stateId = null;
        $typeId = null;
        if($state != null){
            $stateFilter = State::getStateByStateName($state);
            $stateId = $stateFilter->getId();
        }
        if($type != null){
            $typeFilter = Type::getTypeByTypeName($type);
            $typeId = $typeFilter->getId();
        }
        $allInstrument= [];
        $instrumentQuery = DB::table('instrument')->join('sell', 'sell.id', '=', 'instrument.id_sell' );
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
        if($instrumentQuery!=null){
            foreach($instrumentQuery as $instrument){
                $type = Type::getTypeByID($instrument->id_type_instrument);
                $seller = Seller::getSellerByID($instrument->id_seller);
                $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->id);
                $state = State::getStateByID($instrument->id_state);
                $sell = Sell::getSellByID($instrument->id_sell);
                $description = $instrument->description == null ? "" : $instrument->description; 
                $allInstrument[] = new InstrumentBuilder($instrument->id, $instrument->name, $description, $type, $state, $seller, $image, $sell);
            }
        }
        return $allInstrument;
    }


    public static function getAllInstrumentWithSearch($value){ 
        $allInstrument= [];
        $instrumentQuery = null;
        $instrumentQuery = DB::table('instrument')
            ->join('type_instrument', 'instrument.id_type_instrument', '=', 'type_instrument.id')
            ->join('state', 'instrument.id_state', '=', 'state.id')
            ->whereAny([
                'type_instrument.type',
                'state.state',
                'instrument.name',
            ], 'LIKE', '%'.$value.'%')
            ->get();
        if($instrumentQuery!=null){
            foreach($instrumentQuery as $instrument){
                $type = Type::getTypeByID($instrument->id_type_instrument);
                $seller = Seller::getSellerByID($instrument->id_seller);
                $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->id);
                $state = State::getStateByID($instrument->id_state);
                $sell = Sell::getSellByID($instrument->id_sell);
                $description = $instrument->description == null ? "" : $instrument->description; 
                $allInstrument[] = new InstrumentBuilder($instrument->id, $instrument->name, $description, $type, $state, $seller, $image, $sell);
                
            }
        }
        return $allInstrument;
    }

    public static function getInstrumentBySeller($id){
        $instrumentQuery = DB::table('instrument')->where('id_seller', '=', $id)->get();
        $allInstrument= [];
        foreach($instrumentQuery as $instrument){
            $type = Type::getTypeByID($instrument->id_type_instrument);
            $seller = Seller::getSellerByID($instrument->id_seller);
            $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->id);
            $state = State::getStateByID($instrument->id_state);
            $sell = Sell::getSellByID($instrument->id_sell);
            $description = $instrument->description == null ? "" : $instrument->description; 
            $allInstrument[] = new InstrumentBuilder($instrument->id, $instrument->name, $description, $type, $state, $seller, $image, $sell);
        }
        return $allInstrument;
    }
    
    public static function getInstrumentByOrderId($id){
        $instrumentQuery = DB::table('instrument')
        ->join('instrument_has_order', 'instrument_has_order.Instrument_idInstrument', '=', 'instrument.idInstrument')
        ->where('instrument_has_order.Order_idOrder', '=', $id)
        ->get()
        ->first();
        $type = Type::getTypeByID($instrumentQuery->id_type_instrument);
        $seller = Seller::getSellerByID($instrumentQuery->id_seller);
        $image = InstrumentHasImage::getAllImageByInstrumentId($instrumentQuery->id);
        $state = State::getStateByID($instrumentQuery->id_state);
        $sell = Sell::getSellByID($instrumentQuery->id_sell);
        $description = $instrumentQuery->description == null ? "" : $instrumentQuery->description; 
        $instrument = new InstrumentBuilder($instrumentQuery->id, $instrumentQuery->name, $description, $type, $state, $seller, $image, $sell);
        return $instrument;
    }
}
