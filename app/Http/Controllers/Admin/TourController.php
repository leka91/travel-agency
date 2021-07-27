<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTourRequest;
use App\Models\Category;
use App\Models\Requirement;

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
        $locations = collect($request->locations)->filter(function ($value) {
            return $value['latitude'] != null && $value['longitude'] != null;
        })->toArray();
        
        $data = [
            'locations' => $locations
        ];

        dd($data);
    }
}
