<?php

namespace App\Http\Requests\Kids;

use Illuminate\Foundation\Http\FormRequest;

class StoreKidRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // NOTE(ex 2): correction + ajouts de régles
        return [
            "name" => "required|string|min:1|max:250",
            "birthDate" => "required|date_format:Y-m-d\TH:i:sP", // https://www.php.net/manual/en/datetime.format.php
            "address" => "required|string|min:1|max:250",
            "zipCode" => "required|integer|digits:4",
            "city" => "required|string|min:1|max:250",
            "wishList" => "nullable|string|min:0|max:2000",
        ];
    }
}
