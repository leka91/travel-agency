<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactFormMessage;
use App\Models\Category;
use App\Models\Tour;

class PageController extends Controller
{
    protected $simplePerPage = 9;
    
    public function home()
    {
        $latestThree = Tour::select(
            'id',
            'subtitle',
            'title',
            'slug',
            'hero_image'
        )
        ->with('prices')
        ->latest()
        ->limit(3)
        ->get();

        $latestSix = Tour::select(
            'id',
            'category_id',
            'title',
            'slug',
            'hero_image'
        )
        ->with('category')
        ->latest()
        ->limit(6)
        ->get();

        return view('pages.home', compact('latestThree', 'latestSix'));
    }

    public function tagRelatedTours($tagSlug)
    {
        $tours = Tour::select(
            'id',
            'category_id',
            'subtitle',
            'title',
            'slug',
            'hero_image'
        )->with([
            'category',
            'tags',
            'requirements',
            'prices'
        ])
        ->tagRelatedPosts($tagSlug)
        ->latest()
        ->simplePaginate($this->simplePerPage);

        return view('pages.tours', compact('tours'));
    }

    public function categoryRelatedTours($categorySlug)
    { 
        $category = Category::select('id')
            ->where('slug', $categorySlug)
            ->firstOrFail();
        
        $tours = Tour::select(
            'id',
            'category_id',
            'subtitle',
            'title',
            'slug',
            'hero_image'
        )->with([
            'category',
            'tags',
            'requirements',
            'prices'
        ])
        ->where('category_id', $category->id)
        ->latest()
        ->simplePaginate($this->simplePerPage);
        
        return view('pages.tours', compact('tours'));
    }

    public function tours()
    {
        $tours = Tour::select(
            'id',
            'category_id',
            'subtitle',
            'title',
            'slug',
            'hero_image'
        )->with([
            'category',
            'tags',
            'requirements',
            'prices'
        ])
        ->latest()
        ->simplePaginate($this->simplePerPage);
        
        return view('pages.tours', compact('tours'));
    }

    public function showTour($tourSlug)
    {
        $tour = Tour::with([
            'category',
            'tags',
            'requirements',
            'galleries',
            'videos',
            'prices'
        ])
        ->where('slug', $tourSlug)
        ->firstOrFail();
        
        $categories = Category::withCount('tours')
            ->having('tours_count', '>', 0)
            ->get();

        return view('pages.show-tour', compact('tour', 'categories'));
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
