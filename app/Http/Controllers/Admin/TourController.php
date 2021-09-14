<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTourRequest;
use App\Models\Category;
use App\Models\Requirement;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function getAlltours()
    {
        $tours = Tour::with([
            'requirements',
            'category'
        ])->sortable()->paginate(10);
        
        return view('auth.tours.tours', compact('tours'));
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
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'subtitle'         => $request->subtitle,
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'description'      => clean($request->description),
            'steps'            => $request->steps,
            'about'            => $request->about,
            'concept'          => $request->concept,
            'price'            => $request->price,
            'hero_image'       => TourService::getHeroImage($request->heroimage)
        ];

        $tour = $user->tours()->create($data);

        if ($request->locations) {
            $locations = TourService::getLocations($request->locations);
            $tour->locations()->createMany($locations);
        }

        if ($request->requirements) {
            $requirements = TourService::checkForExistingRows(
                $request->requirements
            );
            $tour->requirements()->sync($requirements);
        }

        if ($request->gallery) {
            $images = TourService::getGalleryImages(
                $request->gallery,
                $tour->id
            );
            $tour->galleries()->createMany($images);
        }

        return back()->with('status', 'You have added tour successfully');
    }

    public function editTourForm(Tour $tour)
    {
        $tour->load('requirements', 'locations');
        
        $categories   = Category::all();
        $requirements = Requirement::all();

        dd($tour->toArray());

        return view('auth.tours.edit-tour', compact('tour', 'categories', 'requirements'));
    }
}
