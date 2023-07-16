<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function ScopeHasdisliked(Builder $q, string $signature): bool
    {
        return $q->where("user_signature", $signature)->exists();
    }
}
