<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\Comment\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());

        return response()->json(["message" => "comment created successfully", "data" => $comment]);
    }
}
