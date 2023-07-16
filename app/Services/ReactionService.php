<?php

namespace App\Services;

use App\Actions\Reactions\Dislike;
use App\Actions\Reactions\Like;
use App\Actions\Reactions\Reactable;

class ReactionService
{
	public function like(Reactable $reactable, string $userSignature)
	{
		if ($reactable->dislikes()->hasDisliked($userSignature)) {
			(new Dislike)->undislike($reactable, $userSignature);
		}

		(new Like)->toggle($reactable, $userSignature);
	}

	public function dislike(Reactable $reactable, string $userSignature)
	{
		if ($reactable->likes()->hasLiked($userSignature)) {
			(new Like)->unlike($reactable, $userSignature);
		}

		(new Dislike)->toggle($reactable, $userSignature);
	}
}
