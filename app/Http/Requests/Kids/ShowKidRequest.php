<?php

namespace App\Http\Requests\Kids;

use App\Models\Kid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ShowKidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        if ($user->tokenCan('*') || $user->tokenCan('kids:read:all')) {
            return true;
        }

        $kid = $this->route("kid");

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }
}
