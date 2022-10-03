<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    
    protected $fillable = [ 
        'title', 
        'image',
        'description', 
    ];

    public function scopegetBanner()
    {
        $banners = Banner::latest()->paginate(4);

        return $banners;
    }
}
