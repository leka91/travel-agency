<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Notifications\TourInquiry;
use App\Services\CacheService;
use App\Services\TourService;
use Illuminate\Support\Facades\Notification;

class PageController extends Controller
{
    protected $perPage = 9;
    
    public function home()
    {
        $topNineTours = CacheService::getCachedPopularTours();
        
        $latestThree = $topNineTours->slice(0,3)->values();
        $latestSix   = $topNineTours->slice(3)->values();

        return view('pages.home', compact('latestThree', 'latestSix'));
    }

    public function tagRelatedTours($tagSlug)
    {
        $page = request('page', 1);
        
        $tours = TourService::getTagRelatedTours(
            $page,
            $this->perPage,
            $tagSlug
        );

        return view('pages.tours', compact('tours'));
    }

    public function categoryRelatedTours($categorySlug)
    {
        $page = request('page', 1);
        
        $tours = TourService::getCategoryRelatedTours(
            $page,
            $this->perPage,
            $categorySlug
        );
        
        return view('pages.tours', compact('tours'));
    }

    public function tours()
    {
        $page = request('page', 1);
        
        $tours = TourService::getAllTours($page, $this->perPage);

        return view('pages.tours', compact('tours'));
    }

    public function popularTours()
    {
        $page = request('page', 1);
        
        $tours = TourService::getPopularTours($page, $this->perPage);

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

        Notification::route(
            'mail',
            'office@getawayserbia.com'
        )->notify(new TourInquiry($data));

        return back()->with('status', 'You have successfully sent the message');
    }
}
