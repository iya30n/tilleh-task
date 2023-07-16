<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DislikeController extends Controller
{
    public function news(News $news, Request $request)
    {
        if ($news->dislikes()->where(["user_signature" => $request->fingerprint()])->exists()) {
            DB::transaction(function () use ($news, $request) {
                $lockedNews = $news->lockForUpdate()->first();
                $lockedNews->decrement("dislikes_count");
                $news->dislikes()->where(["user_signature" => $request->fingerprint()])->delete();
            });

            return response()->json(["message" => "you've un-disliked the news."]);
        }

        DB::transaction(function () use ($news, $request) {
            $lockedNews = $news->lockForUpdate()->first();
            $lockedNews->increment("dislikes_count");
            $news->dislikes()->create(["user_signature" => $request->fingerprint()]);
        });

        return response()->json(["message" => "you've disliked the news."]);
    }

    public function comment(Comment $comment, Request $request)
    {
        if ($comment->dislikes()->where(["user_signature" => $request->fingerprint()])->exists()) {
            DB::transaction(function () use ($comment, $request) {
                $lockedNews = $comment->lockForUpdate()->first();
                $lockedNews->decrement("dislikes_count");
                $comment->dislikes()->where(["user_signature" => $request->fingerprint()])->delete();
            });

            return response()->json(["message" => "you've un-disliked the comment."]);
        }

        DB::transaction(function () use ($comment, $request) {
            $lockedNews = $comment->lockForUpdate()->first();
            $lockedNews->increment("dislikes_count");
            $comment->dislikes()->create(["user_signature" => $request->fingerprint()]);
        });

        return response()->json(["message" => "you've disliked the comment."]);
    }
}
