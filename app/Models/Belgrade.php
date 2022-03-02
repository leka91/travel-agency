<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belgrade extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'belgrade_quotes';

    public function belgradeImage()
    {
        return asset("/storage/uploads/belgradeimage/{$this->belgrade_image}");
    }
}
