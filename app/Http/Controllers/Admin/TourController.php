<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class TourController extends Controller
{
    public function tours()
    {
        return view('auth.tours.tours');
    }

    public function newTourForm()
    {
        $categories = Category::all();
        
        return view('auth.tours.add-new-tour', compact('categories'));
    }
}
