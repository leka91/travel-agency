<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTourRequest;
use App\Http\Requests\DeleteTourRequest;
use App\Http\Requests\EditTourRequest;
use App\Models\Category;
use App\Models\Requirement;
use App\Models\Tag;
use App\Models\Tour;
use App\Services\TourService;
use App\Services\UtilityService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function getAlltours()
    {
        $tours = Tour::with([
            'requirements',
            'tags',
            'category'
        ])->sortable()->paginate(10);

        $removedToursCount = Tour::onlyTrashed()->count();
        
        return view('auth.tours.tours', compact('tours', 'removedToursCount'));
    }

    public function newTourForm()
    {
        $categories   = Category::all();
        $requirements = Requirement::all();
        $tags         = Tag::all();
        
        return view('auth.tours.add-new-tour', compact(
            'categories',
            'requirements',
            'tags'
        ));
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
            $requirements = UtilityService::checkForExistingRows(
                $request->requirements,
                Requirement::class
            );
            $tour->requirements()->sync($requirements);
        }

        if ($request->tags) {
            $tags = UtilityService::checkForExistingRows(
                $request->tags,
                Tag::class
            );
            $tour->tags()->sync($tags);
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
        $tour->load('requirements', 'tags', 'galleries', 'locations');
        
        $categories   = Category::all();
        $requirements = Requirement::all();
        $locations    = TourService::getUpdatedLocations($tour->locations);
        $tags         = Tag::all();

        return view('auth.tours.edit-tour', compact(
            'tour', 
            'categories', 
            'requirements',
            'locations',
            'tags'
        ));
    }

    public function editTour(EditTourRequest $request, Tour $tour)
    {
        $tour->load('requirements', 'tags', 'locations');
        
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
            $requirements = UtilityService::checkForExistingRows(
                $request->requirements,
                Requirement::class
            );
            $tour->requirements()->sync($requirements);
        } else {
            if ($tour->requirements) {
                $tour->requirements()->detach();
            }
        }

        if ($request->tags) {
            $tags = UtilityService::checkForExistingRows(
                $request->tags,
                Tag::class
            );
            $tour->tags()->sync($tags);
        } else {
            if ($tour->tags) {
                $tour->tags()->detach();
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

    public function removeTour(DeleteTourRequest $request)
    {
        $tourId = $request->tour_id;
        $tour   = Tour::find($tourId);

        if (!$tour) {
            return back()->with('error', 'Tour not found');
        }

        $tour->delete();

        return redirect()
            ->route('admin.getAlltours')
            ->with('status', 'You have removed tour successfully');
    }

    public function getAllRemovedTours()
    {
        $tours = Tour::with('category')
            ->onlyTrashed()
            ->sortable()
            ->paginate(10);

        return view('auth.tours.removed-tours', compact('tours'));
    }

    public function restoreTour($id)
    {
        $tour = Tour::onlyTrashed()->find($id);

        if (!$tour) {
            return back()->with('error', 'Tour not found');
        }

        $tour->restore();

        return redirect()
            ->route('admin.getAlltours')
            ->with('status', 'You have restored tour successfully');
    }

    public function deleteTour(DeleteTourRequest $request)
    {
        $tourId = $request->tour_id;
        $tour   = Tour::with(['galleries'])->onlyTrashed()->find($tourId);

        if (!$tour) {
            return back()->with('error', 'Tour not found');
        }

        if ($tour->hero_image) {
            $image = $tour->hero_image;
            $file  = storage_path("app/public/uploads/heroimage/{$image}");

            if (File::exists($file)) {
                File::delete($file);
            }
        }

        if ($tour->galleries) {
            $folder = storage_path("app/public/uploads/gallery/{$tourId}");

            if (File::exists($folder)) {
                File::deleteDirectory($folder);
            }
        }
        
        $tour->forceDelete();

        return redirect()
            ->route('admin.getAlltours')
            ->with('status', 'You have deleted tour successfully');
    }
}
