<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function tours()
    {
        return view('auth.tours.tours');
    }

    public function addNewTour()
    {
        return view('auth.tours.add-new-tour');
    }
}
