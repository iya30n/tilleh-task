<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];

    public function likeable()
    {
        return $this->morphTo();
    }
}
