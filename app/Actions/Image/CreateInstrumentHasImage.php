<?php

namespace App\Actions\Image;

use App\Models\InstrumentHasImage;

class CreateInstrumentHasImage
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create($idInstrument, $idImage): InstrumentHasImage
    {   
                       
        $instrumentHasImage = InstrumentHasImage::create([
            'id_instrument' => $idInstrument,
            'id_image' => $idImage
        ]);

        return $instrumentHasImage;
    }
}
