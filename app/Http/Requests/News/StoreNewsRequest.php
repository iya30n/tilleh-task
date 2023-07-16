<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Traits\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            "title" => "required|max:255",
            "content" => "required|string",
            "thumbnail" => "required|image|mimes:jpeg,jpg,png|max:1000"
        ];
    }
}
