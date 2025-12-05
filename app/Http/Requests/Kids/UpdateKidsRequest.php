<?php

namespace App\Http\Requests\Kids;

use App\Http\Requests\AbilityBasedRequest;
use App\Models\Kid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// NOTE(ex 3): Fichier ajouté avec la cmd
// `php artisan make:request Kids/UpdateKidsRequest`
class UpdateKidsRequest extends AbilityBasedRequest
{

    // NOTE(ex 4): Add abilities
    public function getAbilities(): array
    {
        return ["*", "kids:update"];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // NOTE(ex 3): Ajout des rules pour UpdateKids en utilisant les const
        // déclarés dans la classe `Kid`
        return [
            'wiseLevel' => [
                'nullable',
                'string',
                Rule::in([
                    Kid::WISE_LEVEL_1,
                    Kid::WISE_LEVEL_2,
                    Kid::WISE_LEVEL_3,
                    Kid::WISE_LEVEL_4,
                ]),
            ],
        ];
    }
}
