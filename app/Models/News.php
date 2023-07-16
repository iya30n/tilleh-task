<?php

namespace App\Models;

use App\Actions\Reactions\Reactable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class News extends Model implements Reactable
{
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

    public function getThumbnailAttribute($value)
    {
        return Storage::disk("s3")->url($value);
    }
}
