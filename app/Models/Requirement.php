<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Requirement extends Model
{
    use Sortable;

    protected $guarded = [];
    public $sortable = [
        'id', 
        'name', 
        'created_at'
    ];
}
