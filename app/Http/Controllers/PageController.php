<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactFormMessage;
use App\Models\Category;
use App\Models\Tour;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function tours()
    {
        $tours = Tour::select(
            'id',
            'category_id',
            'subtitle',
            'title',
            'slug',
            'price',
            'hero_image',
            'description',
            'created_at'
        )->with([
            'category',
            'tags',
            'requirements',
            'galleries'
        ])->latest()->simplePaginate(9);
        
        return view('pages.tours', compact('tours'));
    }

    public function showTour(Tour $tour)
    {
        $tour->load('category', 'tags', 'requirements');

        $categories = Category::withCount('tours')->get();

        $filteredCategories = $categories->filter(function ($category) {
            return $category->tours_count != 0;
        });

        return view('pages.show-tour', compact('tour', 'filteredCategories'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContactMessage(SendContactMessageRequest $request)
    {
        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        SendEmail::dispatch('admin@admin.com', new ContactFormMessage($data));

        return back()->with('status', 'You have successfully sent the message');
    }
}
