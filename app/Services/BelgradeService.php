<?php

namespace App\Services;

use App\Models\TemporaryFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BelgradeService
{
    public static function getUpdatedBelgradeImage($requestBelgradeImage, $belgradeHeroImage)
    {
        $belgradeImage = null;
        
        if ($requestBelgradeImage) {
            if ($belgradeHeroImage) {
                $file = storage_path(
                    "app/public/uploads/belgradeimage/{$belgradeHeroImage}"
                );

                if (File::exists($file)) {
                    File::delete($file);
                }
            }
            $belgradeImage = self::getBelgradeImage($requestBelgradeImage);
        } elseif ($belgradeHeroImage) {
            $belgradeImage = $belgradeHeroImage;
        }

        return $belgradeImage;
    }

    public static function getBelgradeImage($belgradeImage)
    {
        $folderName = $belgradeImage;

        $temporaryFile = TemporaryFile::where('folder', $folderName)->first();
        
        if ($temporaryFile) {
            $folder   = $temporaryFile->folder;
            $filename = $temporaryFile->filename;

            $filenamePath = storage_path(
                "app/public/uploads/tmp/{$folder}/{$filename}"
            );

            $folderPath = storage_path("app/public/uploads/tmp/{$folder}");

            $file = new UploadedFile($filenamePath, $filename);

            $imagePath = $file->store('uploads/belgradeimage', 'public');

            $image = explode('/', $imagePath)[2];

            Image::make(public_path("/storage/{$imagePath}"))
                ->resize(950, 500)
                ->save();

            File::deleteDirectory($folderPath);

            $temporaryFile->delete();

            return $image;
        }
    }
}
