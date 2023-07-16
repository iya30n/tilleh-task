<?php

namespace App\Models;

use App\Actions\Reactions\Reactable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model implements Reactable
{
    protected $guarded = ["id", "created_at", "updated_at"];

    public function news()
    {
        return $this->belongsTo(News::class);
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