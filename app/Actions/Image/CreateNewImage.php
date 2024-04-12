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
    public function create(string $input, $id): Image
    {   
                       
        $image = Image::create([
            'path' => $input,
            'createIdUser' => $id
        ]);

        return $image;
    }
}
