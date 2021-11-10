<?php

namespace App\Http\Controllers;

use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function getImage(string $image, ?int $width = 150)
    {
        $image = ImageRepository::getClientImageByWidth($image, $width);

        if (!$image) {
            return response()->json(
                ['message' => __('messages.errors.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }

        return $image;
    }
}
