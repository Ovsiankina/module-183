<?php

namespace App\Http\Requests\Tokens;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // L'autorisation est gérée par le middleware sanctum/ability dans le fichier de routes
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:1|max:30",
            "abilities" => "required|array|min:1",
            "abilities.*" => [
                "required",
                "string",
                "distinct",
                Rule::in(["*", "kids:list", "kids:read:all", "kids:update"])
            ],
        ];
    }
}
