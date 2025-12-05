<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbilityBasedRequest extends FormRequest
{
    /**
     * @return array<string>
     */
    public abstract function getAbilities(): array;

    public function authorize(): bool
    {
        $user = $this->user();
        if ($user) {
            $abilities = $this->getAbilities();
            foreach ($abilities as $ability) {
                if ($user->tokenCan($ability)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function rules(): array
    {
        return [];
    }
}
