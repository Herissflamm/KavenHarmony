<?php

namespace App\Actions\Product;

use App\Actions\Image\CreateInstrumentHasImage;
use App\Actions\Image\CreateNewImage;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CreateNewProduct
{
    /**
     * Validate and create a new product.
     *
     * @param  array<string, string>  $input
     */
    public function create(Request $request, $idTypeInstrument, $idState, $idUser, $idSell, $idRent): Instrument
    {
        $input = $request->all();              
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
        ])->validate();

        if(isset($request["images"])){
            if($request["images"] != null ){
                Validator::make(
                    $request['images'], [
                        'images.*' => 'required|mimes:jpg,jpeg,png,bmp|max:10240'
                    ],[
                        'images.*.required' => 'Please upload an image',
                        'images.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                        'images.*.max' => 'Sorry! Maximum allowed size for an image is 10MB',
                    ]
                )->validate();
            }
        }

        $product = Instrument::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'id_type_instrument' => $idTypeInstrument,
            'id_state' => $idState,
            'id_seller' => $idUser,
            'id_rent' => $idRent,
            'id_sell' => $idSell,
        ]);
        if(isset($request["images"])){
            if($request["images"] != null ){
                
                
                $storageImage = new CreateNewImage();
                $instrumentHasImage = new CreateInstrumentHasImage();
                $i = 0;
                foreach($request['images'] as $image){            
                    $imageName = $i.time().'.'.\File::extension($image->getClientOriginalName());  
                    $image->move(public_path('images'), $imageName);
                    $imageVal = $storageImage->create($imageName, $idUser);
                    $imageId = $imageVal->id;
                    if($imageId != null){
                        $instrumentHasImage->create($product->id, $imageId);
                    }else{
                    }
                    $i++;
                }
            }
        }

        return $product;
    }
}
