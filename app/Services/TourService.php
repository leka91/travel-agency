<?php

namespace App\Services;

use App\Models\TemporaryFile;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TourService
{
    public static function getUpdatedHeroImage($requestHeroImage, $tourHeroImage)
    {
        $heroImage = null;
        
        if ($requestHeroImage) {
            if ($tourHeroImage) {
                Storage::disk('public')->delete(
                    "uploads/heroimage/{$tourHeroImage}"
                );

                Storage::disk('public')->delete(
                    "uploads/thumbnail/{$tourHeroImage}"
                );
            }
            $heroImage = self::getHeroImage($requestHeroImage);
        } elseif ($tourHeroImage) {
            $heroImage = $tourHeroImage;
        }

        return $heroImage;
    }
    
    public static function getUpdatedLocations($locations)
    {
        $mappedLocations = collect($locations)->map(function($item) {
            return [
                'lat' => $item['lat'],
                'lng' => $item['lng']
            ];
        });

        if ($mappedLocations->count() < 10) {
            $currentNumberOfLocations   = $mappedLocations->count();
            $remainingNumberOfLocations = 10 - $currentNumberOfLocations;

            for ($i = $remainingNumberOfLocations; $i > 0; $i--) {
                $mappedLocations->push([
                    'lat' => '',
                    'lng' => ''
                ]);
            }
        }

        return $mappedLocations;
    }
    
    public static function getLocations($locations)
    {
        return collect($locations)->filter(function ($value) {
            return $value['lat'] != null && $value['lng'] != null;
        })->values()->toArray();
    }

    public static function getHeroImage($heroImage)
    {
        $folderName = $heroImage;

        $temporaryFile = TemporaryFile::where('folder', $folderName)->first();
        
        if ($temporaryFile) {
            $folder   = $temporaryFile->folder;
            $filename = $temporaryFile->filename;

            $filenamePath = storage_path(
                "app/public/uploads/tmp/{$folder}/{$filename}"
            );

            $folderPath = storage_path("app/public/uploads/tmp/{$folder}");

            $file = new UploadedFile($filenamePath, $filename);

            $imagePath     = $file->store('uploads/heroimage', 'public');
            $thumbnailPath = $file->store('uploads/thumbnail', 'public');

            $image     = explode('/', $imagePath)[2];
            $thumbnail = explode('/', $thumbnailPath)[2];

            $publicImagePath     = "/storage/uploads/heroimage/{$image}";
            $publicThumbnailPath = "/storage/uploads/thumbnail/{$thumbnail}";

            Image::make(public_path($publicImagePath))
                ->resize(950, 500)
                ->save();

            Image::make(public_path($publicThumbnailPath))
                ->resize(360, 220)
                ->save();

            FileFacade::deleteDirectory($folderPath);

            $temporaryFile->delete();

            return $image;
        }
    }

    public static function getGalleryImages($gallery, $tourId)
    {
        $images = [];
        $timestamp = explode('-', $gallery)[1];

        $temporaryFiles = TemporaryFile::where('timestamp', $timestamp)->get();

        foreach ($temporaryFiles as $temporaryFile) {
            if ($temporaryFile) {
                $folder   = $temporaryFile->folder;
                $filename = $temporaryFile->filename;

                $filenamePath = storage_path(
                    "app/public/uploads/tmp/{$folder}/{$filename}"
                );

                $folderPath = storage_path("app/public/uploads/tmp/{$folder}");

                $file = Storage::putFile(
                    "public/uploads/gallery/{$tourId}", new File($filenamePath)
                );

                $image = explode('/', $file)[4];
                $images[] = [
                    'image' => $image
                ];

                FileFacade::deleteDirectory($folderPath);

                $temporaryFile->delete();
            }
        }

        return $images;
    }
}
