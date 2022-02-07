<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactFormMessage;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    protected $simplePerPage = 9;
    
    public function home()
    {
        $topNineTours = Cache::rememberForever('popular_tours', function () {
            return Tour::select(
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
        });
        
        $latestThree = $topNineTours->slice(0,3)->values();
        $latestSix   = $topNineTours->slice(3)->values();

        return view('pages.home', compact('latestThree', 'latestSix'));
    }

    public function tagRelatedTours($tagSlug)
    {
        $page = request('page', 1);
        
        $tours = Cache::rememberForever("tag_tours_{$page}", function () use ($tagSlug) {
            return Tour::select(
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
            ->with([
                'tags' => function ($query) {
                    $query->select('tags.name', 'tags.slug');
                }
            ])
            ->join('categories', 'tours.category_id', '=', 'categories.id')
            ->tagRelatedPosts($tagSlug)
            ->latest('tours.created_at')
            ->simplePaginate(9);
        });

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
        )
        ->with([
            'tags' => function ($query) {
                $query->select('tags.name', 'tags.slug');
            }
        ])
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
        ->with([
            'tags' => function ($query) {
                $query->select('tags.name', 'tags.slug');
            }
        ])
        ->join('categories', 'tours.category_id', '=', 'categories.id')
        ->latest('tours.created_at')
        ->simplePaginate($this->simplePerPage);

        return view('pages.tours', compact('tours'));
    }

    public function showTour($tourSlug)
    {
        $tour = Tour::with([
            'tags' => function ($query) {
                $query->select('tags.name', 'tags.slug');
            },
            'requirements' => function ($query) {
                $query->select('requirements.name');
            },
            'galleries' => function ($query) {
                $query->select('galleries.image', 'galleries.tour_id');
            },
            'videos' => function ($query) {
                $query->select('videos.video_link', 'videos.tour_id');
            },
            'prices' => function ($query) {
                $query->select('prices.name', 'prices.amount', 'prices.tour_id');
            }
        ])
        ->join('categories', 'tours.category_id', '=', 'categories.id')
        ->where('tours.slug', $tourSlug)
        ->firstOrFail([
            'tours.id',
            'tours.user_id',
            'tours.category_id',
            'tours.title',
            'tours.subtitle',
            'tours.description',
            'tours.hero_image',
            'tours.slug',
            'tours.meta_description',
            'tours.meta_keywords',
            'categories.name AS category_name',
            'categories.slug AS category_slug'
        ]);
        
        $categories = Category::select('id', 'name', 'slug')
            ->withCount('tours')
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
        $count = Tour::count('id');

        $totalPages = (int) ceil($count / 9);

        for ($i = 1; $i <= $totalPages; $i++) { 
            dump($i);
        }

        dump($totalPages);
        
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
