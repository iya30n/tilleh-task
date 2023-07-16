<?php

namespace App\Actions\Reactions;

use Illuminate\Support\Facades\DB;

class Dislike
{
	public function toggle(Reactable $reactable, string $userSignature)
	{
		$reactable->dislikes()->hasDisliked($userSignature) ?
			$this->undislike($reactable, $userSignature) :
			$this->dislike($reactable, $userSignature);
	}

	public function dislike(Reactable $r, string $signature)
	{
		DB::transaction(function () use ($r, $signature) {
			$r = $r->lockForUpdate()->first();

			$r->increment("dislikes_count");
			$r->dislikes()->create(["user_signature" => $signature]);
		});
	}

	public function undislike(Reactable $r, string $signature)
	{
		DB::transaction(function () use ($r, $signature) {
			$r = $r->lockForUpdate()->first();

			$r->decrement("dislikes_count");
			$r->dislikes()->where(["user_signature" => $signature])->delete();
		});
	}
}
