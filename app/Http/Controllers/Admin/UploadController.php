<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function storeHeroImage(Request $request)
    {
        if ($request->hasFile('heroimage')) {
            $file = $request->file('heroimage');

            if (!in_array($file->extension(), ['jpeg','png','jpg'])) {
                return response()->json(
                    'Invalid image format', 422
                );
            }
    
            if ($file->getSize() > 1e+6) {
                return response()->json(
                    'Image size is exceeding 1 Mb', 422
                );
            }

            $image  = getimagesize($file);
            $width  = $image[0];
            $height = $image[1];

            if ($width < 950 && $height < 500) {
                return response()->json(
                    'The image should be at least 950px in length and 500px in height', 422
                );
            }

            $fileName = $file->getClientOriginalName();
            $folder   = uniqid();
            $file->storeAs('uploads/tmp/' . $folder, $fileName, 'public');
    
            TemporaryFile::create([
                'folder'    => $folder,
                'filename'  => $fileName
            ]);
    
            return $folder;
        }

        return '';
    }
    
    public function store(Request $request)
    {
        if ($request->hasFile('gallery')) {
            $file = $request->file('gallery');

            if (!in_array($file->extension(), ['jpeg','png','jpg'])) {
                return response()->json(
                    'Invalid image format', 422
                );
            }
    
            if ($file->getSize() > 1e+6) {
                return response()->json(
                    'Image Size is exceeding 1 Mb', 422
                );
            }
    
            $fileName = $file->getClientOriginalName();
            $timestamp = now()->roundYear()->timestamp;
            $folder = uniqid() . '-' . $timestamp;
            $file->storeAs('uploads/tmp/' . $folder, $fileName, 'public');
    
            TemporaryFile::create([
                'folder'    => $folder,
                'filename'  => $fileName,
                'timestamp' => $timestamp
            ]);
    
            return $folder;
        }

        return '';
    }

    public function destroy()
    {
        $folderName = request()->getContent(); 

        $folder = storage_path('app/public/uploads/tmp/' . $folderName);

        File::deleteDirectory($folder);

        $temporaryFile = TemporaryFile::where('folder', $folderName)->first();

        if ($temporaryFile) {
            $temporaryFile->delete();
        }

        return '';
    }
}
