<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, "likeable");
    }

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, "dislikeable");
    }
}
