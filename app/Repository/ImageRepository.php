<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageRepository
{
    const CLIENT_ORIGINAL_IMAGE_PATH = 'images/clients/original/';
    const CLIENT_IMAGE_PATH = 'images/clients/';

    const ACCEPTABLE_WIDTH = [
        30, 50, 150, 300, 600
    ];

    public static function storeClientImage(Request $request, string $key = 'image'): string
    {
        $request->file($key)->store(self::CLIENT_ORIGINAL_IMAGE_PATH);

        return $request->file($key)->hashName();
    }

    public static function getClientImageByWidth(string $fileName, ?int $width = 150): ?Response
    {
        if (!in_array($width, self::ACCEPTABLE_WIDTH)) {
            return null;
        }

        $originalImagePath = self::CLIENT_ORIGINAL_IMAGE_PATH . "{$fileName}";
        if (!Storage::exists($originalImagePath)) {
            return null;
        }

        return Image::make(Storage::get($originalImagePath))->fit($width)->response();
    }

    public static function deleteImage(string $image): bool
    {
        try {
            $original = self::CLIENT_ORIGINAL_IMAGE_PATH . $image;
            if (Storage::exists($original)) {
                Storage::delete($original);
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
