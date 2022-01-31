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
        $topNineTours = Tour::select(
            'tours.id',
            'tours.category_id',
            'tours.subtitle',
            'tours.title',
            'tours.slug',
            'tours.price',
            'tours.hero_image',
            'categories.name AS category_name',
            'categories.slug AS category_slug'
        )->join('categories', 'tours.category_id', '=', 'categories.id')
        ->latest('tours.created_at')
        ->limit(9)
        ->get();
        
        $latestThree = $topNineTours->slice(0,3)->values();
        $latestSix   = $topNineTours->slice(3)->values();

        return view('pages.home', compact('latestThree', 'latestSix'));
    }

    public function tagRelatedTours($tagSlug)
    {
        $tours = Tour::select(
            'tours.id',
            'tours.category_id',
            'tours.subtitle',
            'tours.title',
            'tours.slug',
            'tours.price',
            'tours.hero_image',
            'categories.name AS category_name',
            'categories.slug AS category_slug'
        )->with('tags')
        ->join('categories', 'tours.category_id', '=', 'categories.id')
        ->tagRelatedPosts($tagSlug)
        ->latest('tours.created_at')
        ->simplePaginate($this->simplePerPage);

        return view('pages.tours', compact('tours'));
    }

    public function categoryRelatedTours($categorySlug)
    {
        $tours = Tour::select(
            'tours.id',
            'tours.category_id',
            'tours.subtitle',
            'tours.title',
            'tours.slug',
            'tours.price',
            'tours.hero_image',
            'categories.name AS category_name',
            'categories.slug AS category_slug'
        )->with('tags')
        ->join('categories', 'tours.category_id', '=', 'categories.id')
        ->where('categories.slug', $categorySlug)
        ->latest('tours.created_at')
        ->simplePaginate($this->simplePerPage);
        
        return view('pages.tours', compact('tours'));
    }

    public function tours()
    {
        $tours = Tour::select(
            'tours.id',
            'tours.category_id',
            'tours.subtitle',
            'tours.title',
            'tours.slug',
            'tours.price',
            'tours.hero_image',
            'categories.name AS category_name',
            'categories.slug AS category_slug'
        )
        ->with('tags')
        ->join('categories', 'tours.category_id', '=', 'categories.id')
        ->latest('tours.created_at')
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
