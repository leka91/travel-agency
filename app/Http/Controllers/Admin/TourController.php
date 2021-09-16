<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTourRequest;
use App\Http\Requests\DeleteTourRequest;
use App\Http\Requests\EditTourRequest;
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
        $tour->load('requirements', 'galleries', 'locations');
        
        $categories   = Category::all();
        $requirements = Requirement::all();
        $locations    = TourService::getUpdatedLocations($tour->locations);

        return view('auth.tours.edit-tour', compact(
            'tour', 
            'categories', 
            'requirements',
            'locations'
        ));
    }

    public function editTour(EditTourRequest $request, Tour $tour)
    {
        $data = [
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'subtitle'         => $request->subtitle,
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'description'      => clean($request->description),
            'price'            => $request->price,
            'hero_image'       => TourService::getUpdatedHeroImage(
                $request->heroimage,
                $tour->hero_image
            )
        ];

        $tour->update($data);

        if ($request->locations) {
            if ($tour->locations) {
                $tour->locations()->delete();
            }
            $locations = TourService::getLocations($request->locations);
            $tour->locations()->createMany($locations);
        } else {
            if ($tour->locations) {
                $tour->locations()->delete();
            }
        }

        if ($request->requirements) {
            $requirements = TourService::checkForExistingRows(
                $request->requirements
            );
            $tour->requirements()->sync($requirements);
        } else {
            if ($tour->requirements) {
                $tour->requirements()->detach();
            }
        }

        if ($request->gallery) {
            $images = TourService::getGalleryImages(
                $request->gallery,
                $tour->id
            );
            $tour->galleries()->createMany($images);
        }

        return back()->with('status', 'You have updated tour successfully');
    }

    public function deleteTour(DeleteTourRequest $request)
    {
        $tour = Tour::find($request->tour_id);

        if (!$tour) {
            return back()->with('error', 'Tour not found');
        }

        // TODO: Delete tour

        return back()->with('status', 'You have deleted tour successfully');
    }
}
