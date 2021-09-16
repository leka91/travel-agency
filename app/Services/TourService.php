<?php

namespace App\Services;

use App\Models\Requirement;
use App\Models\TemporaryFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

            $file = Storage::putFile(
                'public/uploads/heroimage', new File($filenamePath)
            );

            $image = explode('/', $file)[3];

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

    public static function checkForExistingRows($records) 
    {   
        $recordsArr = [];

        foreach ($records as $record) {
            $existingRecord = Requirement::find($record);

            if (is_null($existingRecord)) {
                $newRecord = Requirement::create([
                    'name' => $record,
                    'slug' => Str::slug($record)
                ]);
                $recordsArr[] = (string) $newRecord->id; 
                continue;
            }

            $recordsArr[] = $record;
        }

        return $recordsArr;
    }
}
