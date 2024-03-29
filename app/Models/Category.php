<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use Sortable;

    protected $table = 'categories';
    protected $guarded = [];
    public $sortable = [
        'id', 
        'name', 
        'created_at'
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
