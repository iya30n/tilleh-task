<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\ReactionService;

class LikeController extends Controller
{
    public function news(News $news, Request $request)
    {
        (new ReactionService)->like($news, $request->getClientIp());

		return response()->json(["message" => "Success!"]);
    }

    public function comment(Comment $comment, Request $request)
    {
        (new ReactionService)->like($comment, $request->getClientIp());

		return response()->json(["message" => "Success!"]);
    }
}
