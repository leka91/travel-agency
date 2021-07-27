<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Requirement;

class TourController extends Controller
{
    public function tours()
    {
        return view('auth.tours.tours');
    }

    public function newTourForm()
    {
        $categories   = Category::all();
        $requirements = Requirement::all();
        
        return view('auth.tours.add-new-tour', compact('categories', 'requirements'));
    }
}
