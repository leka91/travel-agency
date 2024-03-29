<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Tour extends Model
{
    use SoftDeletes, Sortable;

    protected $guarded = [];
    public $sortable = [
        'id', 
        'title', 
        'subtitle', 
        'created_at',
        'deleted_at'
    ];

    public function scopePopular($query)
    {
        return $query->where('tours.is_popular', 1);
    }

    public function scopeCategoryRelated($query, $categorySlug)
    {
        return $query->join(
            'categories', 'tours.category_id', '=', 'categories.id'
        )->where('categories.slug', $categorySlug);
    }

    public function scopeTagRelated($query, $tagSlug)
    {
        return $query->join('tag_tour', 'tours.id', '=', 'tag_tour.tour_id')
            ->join('tags', 'tag_tour.tag_id', '=', 'tags.id')
            ->where('tags.slug', $tagSlug);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class)->orderBy('amount');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function heroImage()
    {
        return asset("/storage/uploads/heroimage/{$this->hero_image}");
    }

    public function thumbnail()
    {
        return asset("/storage/uploads/thumbnail/{$this->hero_image}");
    }

    public function galleryImage($image)
    {
        return asset("/storage/uploads/gallery/{$this->id}/{$image}");
    }
}
