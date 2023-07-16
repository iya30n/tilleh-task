<?php

namespace App\Actions\Reactions;

use \Illuminate\Database\Eloquent\Relations\MorphMany;

interface Reactable
{
	public function likes(): MorphMany;

	public function dislikes(): MorphMany;
}