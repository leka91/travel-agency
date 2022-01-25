<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactFormMessage;
use App\Models\Category;
use App\Models\Tour;

class PageController extends Controller
{
    protected $perPage = 9;
    
    public function home()
    {
        $latestsThree = Tour::select(
            'id',
            'category_id',
            'subtitle',
            'title',
            'slug',
            'hero_image'
        )
        ->latest()
        ->limit(3)
        ->get();
        
        return view('pages.home', compact('latestsThree'));
    }

    public function services()
    {
        return view('pages.services');
    }

    public function tagRelatedTours($tagSlug)
    {
        $tours = Tour::select(
            'id',
            'category_id',
            'subtitle',
            'title',
            'slug',
            'hero_image',
            'description'
        )->with([
            'category',
            'tags',
            'requirements'
        ])->tagRelatedPosts($tagSlug)
        ->latest()
        ->simplePaginate($this->perPage);

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
            'hero_image',
            'description'
        )->with([
            'category',
            'tags',
            'requirements'
        ])->where('category_id', $category->id)
        ->latest()
        ->simplePaginate($this->perPage);
        
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
            'hero_image',
            'description'
        )->with([
            'category',
            'tags',
            'requirements'
        ])->latest()
        ->simplePaginate($this->perPage);
        
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
        ])->where('slug', $tourSlug)->firstOrFail();
        
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
