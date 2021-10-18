<?php

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;
use Intervention\Image\Facades\Image as IImage;


class ImageService implements ImageRepository
{

    /**
     * @inheritDoc
     */
    public function uploadImage(string $base64, string $path, string $alt): Image
    {
        $name = $this->getName($base64);

        $image = $this->makeImage($base64);

        $this->uploadToDirectory($image, $path, $name);

        $completePath = $path . $name;

        return $this->createInDatabase($completePath, $alt);
    }

    /**
     * Returns the name of the image with the extension
     *
     * @param string $base64
     * @return string
     */
    protected function getName(string $base64): string
    {
        return time() . '.' . explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];
    }

    /**
     * Transform base64 to Image of Intervention Image
     *
     * @param string $base64
     * @return \Intervention\Image\Image
     */
    protected function makeImage(string $base64): \Intervention\Image\Image
    {
        return IImage::make($base64);
    }

    /**
     * Upload the image to the directory
     *
     * @param $image
     * @param string $path
     * @param string $name
     */
    protected function uploadToDirectory($image, string $path, string $name)
    {
        $image->save(storage_path("/app/public/img/" . $path). $name);
    }

    /**
     * Creates the image in the database
     *
     * @param $path | With image name included
     * @param $alt
     * @return Image
     */
    protected function createInDatabase($path, $alt): Image
    {
        return Image::create([
            'src' => $path,
            'alt' => $alt
        ]);
    }
}
