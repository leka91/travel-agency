<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactFormMessage;
use App\Services\CacheService;
use App\Services\TourService;

class PageController extends Controller
{
    public function home()
    {
        $topNineTours = CacheService::getCachedPopularTours();
        
        $latestThree = $topNineTours->slice(0,3)->values();
        $latestSix   = $topNineTours->slice(3)->values();

        return view('pages.home', compact('latestThree', 'latestSix'));
    }

    public function tagRelatedTours($tagSlug)
    {
        $tours = TourService::getTagRelatedTours($tagSlug);

        return view('pages.tours', compact('tours'));
    }

    public function categoryRelatedTours($categorySlug)
    {
        $tours = TourService::getCategoryRelatedTours($categorySlug);
        
        return view('pages.tours', compact('tours'));
    }

    public function tours()
    {
        $page = request('page', 1);
        $perPage = 9;
        
        $tours = TourService::getAllTours($page, $perPage);

        return view('pages.tours', compact('tours'));
    }

    public function popularTours()
    {
        $tours = TourService::getPopularTours();

        return view('pages.tours', compact('tours'));
    }

    public function showTour($tourSlug)
    {
        $tour       = CacheService::getCachedTour($tourSlug);   
        $categories = CacheService::getCachedCategories();

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

    public function belgrade()
    {
        $belgrade   = CacheService::getCachedBelgrade();
        $categories = CacheService::getCachedCategories();
        
        return view('pages.belgrade', compact('belgrade', 'categories'));
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
