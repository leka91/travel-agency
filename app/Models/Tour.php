<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Tour extends Model
{
    use Sortable;

    protected $guarded = [];
    public $sortable = [
        'id', 
        'title', 
        'subtitle', 
        'price', 
        'created_at'
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

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class);
    }
}
