<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $withCount = ['likes'];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'image',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }
}
