<?php

namespace App\Http\Requests\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

trait JsonResponse
{
	/** 
	 * Handle a failed validation attempt.
	 * 
	 * @param \Illuminate\Contracts\Validation\Validator $validator
	 * @return void
	 * 
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function failedValidation(Validator $validator)
	{
		$errors = (new ValidationException($validator))->errors();
		throw new HttpResponseException(
			response()->json(["errors" => collect($errors)], 422)
		);
	}
}
