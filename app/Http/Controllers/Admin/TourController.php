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
use Illuminate\Support\Str;

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
            $locations = $this->getLocations($request->locations);
            $tour->locations()->createMany($locations);
        }

        // if ($request->requirements) {
        //     $requirements = $this->checkForExistingRows($request->requirements);
        //     $tour->requirements()->sync($requirements);
        // }

        // if ($request->gallery) {
        //     $images = $this->getGalleryImages($request->gallery);
        //     $tour->galleries()->createMany($images);
        // }

        return back();
    }

    private function getLocations($locations)
    {
        return collect($locations)->filter(function ($value){
            return $value['lat'] != null && $value['lng'] != null;
        })->values()->toArray();
    }

    private function getHeroImage($heroImage)
    {
        $folderName = $heroImage;

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

    private function getGalleryImages($gallery)
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

    private function checkForExistingRows($records) 
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
