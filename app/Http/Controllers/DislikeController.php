<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use App\Services\ReactionService;

class DislikeController extends Controller
{
    public function news(News $news, ReactionService $reactionService)
    {
        $reactionService->dislike($news, request()->getClientIp());

		return response()->json(["message" => "Success!"]);
    }

    public function comment(Comment $comment, ReactionService $reactionService)
    {
        $reactionService->dislike($comment, request()->getClientIp());

		return response()->json(["message" => "Success!"]);
    }
}
