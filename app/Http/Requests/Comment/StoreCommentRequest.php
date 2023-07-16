<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    use JsonResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "news_id" => "required|exists:news,id",
            "writer_name" => "required|string|max:70",
            "content" => "required|string"
        ];
    }
}
