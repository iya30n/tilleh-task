<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Actions\Reactions\Reactable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends Model implements Reactable
{
    // use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, "likeable");
    }

    public function dislikes(): MorphMany
    {
        return $this->morphMany(Dislike::class, "dislikeable");
    }
}
