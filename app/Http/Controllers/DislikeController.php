<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Actions\Reactions\Dislike;

class DislikeController extends Controller
{
    public function news(News $news, Request $request)
    {
        (new Dislike)->toggle($news, $request->fingerprint());

		return response()->json(["message" => "Success!"]);
    }

    public function comment(Comment $comment, Request $request)
    {
        (new Dislike)->toggle($comment, $request->fingerprint());

		return response()->json(["message" => "Success!"]);
    }
}
