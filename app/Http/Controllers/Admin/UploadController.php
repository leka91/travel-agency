<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // TODO: add new route for hero image
        
        if ($request->hasFile('gallery')) {
            $file = $request->file('gallery');
        } elseif ($request->hasFile('heroimage')) {
            $file = $request->file('heroimage');
        } else {
            return '';
        }

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
            'timestamp' => $request->hasFile('gallery') ? $timestamp : null,
        ]);

        return $folder;
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
