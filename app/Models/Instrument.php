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

    protected $primaryKey = 'idInstrument';
    public $table = 'instrument';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'idTypeInstrument',
        'State_idState',
        'SelleridUser',
        'idImage',
        'Sell_idSell',
        'Rent_idRent'
    ];

    public function profile()
    {
        return $this->belongsTo(Seller::class, "User_idUsers");
    }

    public static function getAllInstrument(){
        $instrumentQuery = DB::table('instrument')->get();
        $allInstrument= [];
        foreach($instrumentQuery as $instrument){
            $type = Type::getTypeByID($instrument->idTypeInstrument);
            $seller = Seller::getSellerByID($instrument->SelleridUser);
            $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->idInstrument);
            $state = State::getStateByID($instrument->State_idState);
            $sell = Sell::getSellByID($instrument->Sell_idSell);
            $description = $instrument->description == null ? "" : $instrument->description; 
            $allInstrument[] = new InstrumentBuilder($instrument->idInstrument, $instrument->name, $description, $type, $state, $seller, $image, $sell);
        }
        return $allInstrument;
    }

    public static function getInstrumentByID($id){
        $instrumentQuery = DB::table('instrument')->where('idInstrument', $id)->first();
        $type = Type::getTypeByID($instrumentQuery->idTypeInstrument);
        $seller = Seller::getSellerByID($instrumentQuery->SelleridUser);
        $image = InstrumentHasImage::getAllImageByInstrumentId($instrumentQuery->idInstrument);
        $state = State::getStateByID($instrumentQuery->State_idState);
        $sell = Sell::getSellByID($instrumentQuery->Sell_idSell);
        $description = $instrumentQuery->description == null ? "" : $instrumentQuery->description; 
        $instrument = new InstrumentBuilder($instrumentQuery->idInstrument, $instrumentQuery->name, $description, $type, $state, $seller, $image, $sell);
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
        $instrumentQuery = null;
        if($typeId != null && $stateId != null){      
            $instrumentQuery = DB::table('instrument')->join('sell', 'sell.idSell', '=', 'instrument.Sell_idSell' )->where('State_idState', $stateId)->where('idTypeInstrument', $typeId)->where('sell.price', '>=', $minPrice)->where('sell.price', '<=', $maxPrice)->get();
        }else if($typeId != null && $stateId == null){
            $instrumentQuery = DB::table('instrument')->join('sell', 'sell.idSell', '=', 'instrument.Sell_idSell' )->where('idTypeInstrument', $typeId)->where('sell.price', '>=', $minPrice)->where('sell.price', '<=', $maxPrice)->get();
        }else if($stateId != null && $typeId == null){
            $instrumentQuery = DB::table('instrument')->join('sell', 'sell.idSell', '=', 'instrument.Sell_idSell' )->where('State_idState', $stateId)->where('sell.price', '>=', $minPrice)->where('sell.price', '<=', $maxPrice)->get();
        }else if($typeId == null && $stateId == null && $minPrice != null && $maxPrice != null){
            $instrumentQuery = DB::table('instrument')->join('sell', 'sell.idSell', '=', 'instrument.Sell_idSell' )->where('sell.price', '>=', $minPrice)->where('sell.price', '<=', $maxPrice)->get();
        }else if($typeId == null && $stateId == null && $minPrice == null && $maxPrice == null){
            $instrumentQuery = DB::table('instrument')->get();
        }
        if($instrumentQuery!=null){
            foreach($instrumentQuery as $instrument){
                $type = Type::getTypeByID($instrument->idTypeInstrument);
                $seller = Seller::getSellerByID($instrument->SelleridUser);
                $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->idInstrument);
                $state = State::getStateByID($instrument->State_idState);
                $sell = Sell::getSellByID($instrument->Sell_idSell);
                $description = $instrument->description == null ? "" : $instrument->description; 
                $allInstrument[] = new InstrumentBuilder($instrument->idInstrument, $instrument->name, $description, $type, $state, $seller, $image, $sell);
            }
        }
        return $allInstrument;
    }


    public static function getAllInstrumentWithSearch($value){ 
        $allInstrument= [];
        $instrumentQuery = null;
        $instrumentQuery = DB::table('instrument')
            ->join('typeInstrument', 'instrument.idTypeInstrument', '=', 'typeInstrument.idTypeInstrument')
            ->join('state', 'instrument.State_idState', '=', 'state.idState')
            ->whereAny([
                'typeInstrument.type',
                'state.state',
                'instrument.name',
            ], 'LIKE', '%'.$value.'%')
            ->get();
        if($instrumentQuery!=null){
            foreach($instrumentQuery as $instrument){
                $type = Type::getTypeByID($instrument->idTypeInstrument);
                $seller = Seller::getSellerByID($instrument->SelleridUser);
                $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->idInstrument);
                $state = State::getStateByID($instrument->State_idState);
                $sell = Sell::getSellByID($instrument->Sell_idSell);
                $description = $instrument->description == null ? "" : $instrument->description; 
                $allInstrument[] = new InstrumentBuilder($instrument->idInstrument, $instrument->name, $description, $type, $state, $seller, $image, $sell);
            }
        }
        return $allInstrument;
    }

    public static function getInstrumentBySeller($id){
        $instrumentQuery = DB::table('instrument')->where('SelleridUser', '=', $id)->get();
        $allInstrument= [];
        foreach($instrumentQuery as $instrument){
            $type = Type::getTypeByID($instrument->idTypeInstrument);
            $seller = Seller::getSellerByID($instrument->SelleridUser);
            $image = InstrumentHasImage::getAllImageByInstrumentId($instrument->idInstrument);
            $state = State::getStateByID($instrument->State_idState);
            $sell = Sell::getSellByID($instrument->Sell_idSell);
            $description = $instrument->description == null ? "" : $instrument->description; 
            $allInstrument[] = new InstrumentBuilder($instrument->idInstrument, $instrument->name, $description, $type, $state, $seller, $image, $sell);
        }
        return $allInstrument;
    }
    
}
