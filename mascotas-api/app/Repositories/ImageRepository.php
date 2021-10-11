<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Pet;

interface ImageRepository
{
    /**
     * Upload the image to the directory and database.
     *
     * @param string $base64
     * @param string $path | It should start with the following path "/app/public/img/", then the name of the folder in which you want to save the image and with "/" at the end
     * @param string $alt
     * @return Image
     */
    public function uploadImage(string $base64, string $path, string $alt): Image;
}