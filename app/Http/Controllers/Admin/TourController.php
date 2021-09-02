<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTourRequest;
use App\Models\Category;
use App\Models\Requirement;
use App\Models\TemporaryFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function getAlltours()
    {
        return view('auth.tours.tours');
    }

    public function newTourForm()
    {
        $categories   = Category::all();
        $requirements = Requirement::all();
        
        return view('auth.tours.add-new-tour', compact('categories', 'requirements'));
    }

    public function addNewTour(AddTourRequest $request)
    {
        $user = auth()->user();

        $data = [
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'hero_image'  => $this->getHeroImage($request->heroimage)
        ];

        $tour = $user->tours()->create($data);

        if ($request->locations) {
            $locations = collect($request->locations)
                ->filter(function ($value){
                    return $value['latitude'] != null && 
                           $value['longitude'] != null;
                })->values()->toArray();
        }

        if ($request->gallery) {
            $images = $this->getGalleryImages($request->gallery);
            $tour->galleries()->createMany($images);
        }

        return back();
    }

    public function getHeroImage($heroImage)
    {
        $folderName = explode('-', $heroImage)[0];

        $temporaryFile = TemporaryFile::where('folder', $folderName)->first();
        
        if ($temporaryFile) {
            $folder   = $temporaryFile->folder;
            $filename = $temporaryFile->filename;

            $filenamePath = storage_path('app/public/uploads/tmp/' . $folder . '/' . $filename);

            $folderPath = storage_path('app/public/uploads/tmp/' . $folder);

            $file = Storage::putFile(
                'public/uploads/heroimage', new File($filenamePath)
            );

            $image = explode('/', $file)[3];

            FileFacade::deleteDirectory($folderPath);

            $temporaryFile->delete();

            return $image;
        }
    }

    public function getGalleryImages($gallery)
    {
        $images = [];
        $timestamp = explode('-', $gallery)[1];

        $temporaryFiles = TemporaryFile::where('timestamp', $timestamp)->get();

        foreach ($temporaryFiles as $temporaryFile) {
            if ($temporaryFile) {
                $folder   = $temporaryFile->folder;
                $filename = $temporaryFile->filename;

                $filenamePath = storage_path('app/public/uploads/tmp/' . $folder . '/' . $filename);

                $folderPath = storage_path('app/public/uploads/tmp/' . $folder);

                $file = Storage::putFile(
                    'public/uploads/gallery', new File($filenamePath)
                );

                $image = explode('/', $file)[3];
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
