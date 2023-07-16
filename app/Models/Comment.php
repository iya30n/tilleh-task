<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, "likeable");
    }
}