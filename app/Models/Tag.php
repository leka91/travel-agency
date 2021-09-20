<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Tag extends Model
{
    use Sortable;

    protected $guarded = [];
    public $sortable = [
        'id', 
        'name', 
        'created_at'
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }
}
