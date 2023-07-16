<?php

namespace App\Actions\Reactions;

use Illuminate\Support\Facades\DB;

class Like
{
	public function toggle(Reactable $reactable, string $userSignature)
	{
		$reactable->likes()->hasLiked($userSignature) ?
			$this->unlike($reactable, $userSignature) :
			$this->like($reactable, $userSignature);
	}

	public function like(Reactable $r, string $signature)
	{
		DB::transaction(function () use ($r, $signature) {
			$r = $r->lockForUpdate()->first();

			$r->increment("likes_count");
			$r->likes()->create(["user_signature" => $signature]);
		});
	}

	public function unlike(Reactable $r, string $signature)
	{
		DB::transaction(function () use ($r, $signature) {
			$r = $r->lockForUpdate()->first();

			$r->decrement("likes_count");
			$r->likes()->where(["user_signature" => $signature])->delete();
		});
	}
}
