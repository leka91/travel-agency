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
        'price', 
        'created_at',
        'deleted_at'
    ];

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
        return $this->hasMany(Price::class);
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

    public function timeToRead() 
    {
        $wordsPerMinute = 200;
        $numOfWords     = str_word_count(strip_tags($this->description));
        $minutes        = $numOfWords / $wordsPerMinute;
        $readTime       = ceil($minutes);

        return "{$readTime} min read";
    }
}
