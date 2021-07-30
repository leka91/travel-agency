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

        // $images = [];


        // for ($i = 1; $i < 6; $i++) { 
        //     $images[] = [
        //         'image' => "image_{$i}.png"
        //     ];
        // }

        // dump($images);

        // dd('*****************');

        // $path = 'public/uploads/heroimage/Y15IwqlH2OrmqcuFkMaXLwHCnDTDyLikKdTLVZSl.png';

        // $file = explode('/', $path)[3];

        // dump($file);

        // dd('****************');
        
        return view('auth.tours.add-new-tour', compact('categories', 'requirements'));
    }

    public function addNewTour(AddTourRequest $request)
    {
        $user = auth()->user();
        
        // $locations = collect($request->locations)->filter(function ($value) {
        //     return $value['latitude'] != null && $value['longitude'] != null;
        // })->values()->toArray();

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'subtitle' => $request->subtitle
        ];

        $tour = $user->tours()->create($data);

        $images = [];

        if ($request->hero_image) {
            $timestamp = explode('-', $request->hero_image)[1];

            $temporaryFiles = TemporaryFile::where('timestamp', $timestamp)
                ->get();

            if ($temporaryFiles->count()) {
                foreach ($temporaryFiles as $temporaryFile) {
                    if ($temporaryFile) {
                        $folder   = $temporaryFile->folder;
                        $filename = $temporaryFile->filename;

                        $filenamePath = storage_path('app/public/uploads/tmp/' . $folder . '/' . $filename);

                        $folderPath = storage_path('app/public/uploads/tmp/' . $folder);

                        $file = Storage::putFile(
                            'public/uploads/heroimage', new File($filenamePath)
                        );

                        $image = explode('/', $file)[3];
                        $images[] = [
                            'image' => $image
                        ];

                        FileFacade::deleteDirectory($folderPath);

                        $temporaryFile->delete();
                    }
                }

                $tour->galleries()->createMany($images);
            }
        }
        
        // $data = [
        //     // 'locations' => $locations,
        //     'hero_image' => $images
        // ];

        dd('SUCCESS');
    }
}
