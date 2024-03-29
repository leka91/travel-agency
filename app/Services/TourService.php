<?php

namespace App\Services;

use App\Models\TemporaryFile;
use App\Models\Tour;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TourService
{
    public static function getTagRelatedTours($page, $perPage, $tagSlug)
    {
        $query = Tour::tagRelated($tagSlug)->latest('tours.created_at');

        $total = $query->count();
        $tours = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get(['tours.id']);

        $cachedTours = self::getCachedTours($tours);

        return $cachedTours->paginate($perPage, $total, $page);
    }
    
    public static function getCategoryRelatedTours(
        $page,
        $perPage,
        $categorySlug
    )
    {
        $query = Tour::categoryRelated($categorySlug)
            ->latest('tours.created_at');

        $total = $query->count();
        $tours = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get(['tours.id']);

        $cachedTours = self::getCachedTours($tours);

        return $cachedTours->paginate($perPage, $total, $page);
    }
    
    public static function getAllTours($page, $perPage)
    {
        $query = Tour::latest('tours.created_at');

        $total = $query->count();
        $tours = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get(['tours.id']);

        $cachedTours = self::getCachedTours($tours);

        return $cachedTours->paginate($perPage, $total, $page);
    }

    public static function getPopularTours($page, $perPage)
    {
        $query = Tour::popular()->latest('tours.created_at');

        $total = $query->count();
        $tours = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get(['tours.id']);

        $cachedTours = self::getCachedTours($tours);

        return $cachedTours->paginate($perPage, $total, $page);
    }

    public static function getCachedTours($tours)
    {
        $cachedTours = collect();

        foreach ($tours as $tour) {
            $cachedTour = CacheService::getCachedTourForList($tour->id);

            $cachedTours->push($cachedTour);
        }

        return $cachedTours;
    }
    
    public static function getUpdatedPrices($prices)
    {
        $mappedPrices = $prices->map(function($item) {
            return [
                'name'   => $item['name'],
                'amount' => $item['amount']
            ];
        });

        if ($mappedPrices->count() < 3) {
            $currentNumberOfPrices   = $mappedPrices->count();
            $remainingNumberOfPrices = 3 - $currentNumberOfPrices;

            for ($i = $remainingNumberOfPrices; $i > 0; $i--) {
                $mappedPrices->push([
                    'name'   => '',
                    'amount' => ''
                ]);
            }
        }

        return $mappedPrices;
    }
    
    public static function getPrices($prices)
    {
        return collect($prices)->filter(function ($value) {
            return $value['name'] != null && $value['amount'] != null;
        })->values()->toArray();
    }
    
    public static function getUpdatedHeroImage(
        $requestHeroImage,
        $tourHeroImage
    )
    {
        $heroImage = null;
        
        if ($requestHeroImage) {
            if ($tourHeroImage) {
                $file      = storage_path(
                    "app/public/uploads/heroimage/{$tourHeroImage}"
                );

                $thumbnail = storage_path(
                    "app/public/uploads/thumbnail/{$tourHeroImage}"
                );

                if (File::exists($file)) {
                    File::delete($file);
                }

                if (File::exists($thumbnail)) {
                    File::delete($thumbnail);
                }
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

            $image = explode('/', $imagePath)[2];

            Image::make(public_path("/storage/{$imagePath}"))
                ->resize(950, 500)
                ->save();

            Image::make(public_path("/storage/{$thumbnailPath}"))
                ->resize(360, 220)
                ->save();

            File::deleteDirectory($folderPath);

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

                $file = new UploadedFile($filenamePath, $filename);

                $imagePath = $file->store(
                    "uploads/gallery/{$tourId}", 'public'
                );

                $image = explode('/', $imagePath)[3];
                $images[] = [
                    'image' => $image
                ];

                File::deleteDirectory($folderPath);

                $temporaryFile->delete();
            }
        }

        return $images;
    }
}
