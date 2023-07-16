<?php

namespace App\Http\Controllers;

use App\Http\Requests\Like\LikeCommentRequest;
use App\Http\Requests\Like\LikeNewsRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function news(News $news, Request $request)
    {
        if ($news->likes()->where(["user_signature" => $request->fingerprint()])->exists()) {
            DB::transaction(function () use ($news, $request) {
                $lockedNews = $news->lockForUpdate()->first();
                $lockedNews->decrement("likes_count");
                $news->likes()->where(["user_signature" => $request->fingerprint()])->delete();
            });

            return response()->json(["message" => "you've un-liked the news."]);
        }

        DB::transaction(function() use ($news, $request) {
            $lockedNews = $news->lockForUpdate()->first();
            $lockedNews->increment("likes_count");
            $news->likes()->create(["user_signature" => $request->fingerprint()]);
        });

        return response()->json(["message" => "you've liked the news."]);
    }

    public function comment(Comment $comment, Request $request)
    {
        if ($comment->likes()->where(["user_signature" => $request->fingerprint()])->exists()) {
            DB::transaction(function () use ($comment, $request) {
                $lockedNews = $comment->lockForUpdate()->first();
                $lockedNews->decrement("likes_count");
                $comment->likes()->where(["user_signature" => $request->fingerprint()])->delete();
            });

            return response()->json(["message" => "you've un-liked the comment."]);
        }

        DB::transaction(function () use ($comment, $request) {
            $lockedNews = $comment->lockForUpdate()->first();
            $lockedNews->increment("likes_count");
            $comment->likes()->create(["user_signature" => $request->fingerprint()]);
        });

        return response()->json(["message" => "you've liked the comment."]);
    }
}
