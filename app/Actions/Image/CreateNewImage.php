<?php

namespace App\Actions\Image;

use App\Models\Image;

class CreateNewImage
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create($image, $id): Image
    {   
                       
        $image = Image::create([
            'path' => $image,
            'id_user' => $id
        ]);

        return $image;
    }
}
