<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'header_image', 
        'content_image',
        'reading_time',
        'category_id', 
        'user_id'
    ];

    public function getReadingTimeAttribute()
    {
        return $this->attributes['reading_time'];
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
