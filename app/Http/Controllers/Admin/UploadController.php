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
        if ($request->hasFile('hero_image')) 
        {
            $file = $request->file('hero_image');
            $fileName = $file->getClientOriginalName();
            $timestamp = now()->roundMinutes(5)->timestamp;
            $folder = uniqid() . '-' . $timestamp;
            $file->storeAs('uploads/tmp/' . $folder, $fileName, 'public');

            TemporaryFile::create([
                'folder'    => $folder,
                'filename'  => $fileName,
                'timestamp' => $timestamp,
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
