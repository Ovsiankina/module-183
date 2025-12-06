<?php

namespace App\Http\Requests\Kids;

use App\Http\Requests\AbilityBasedRequest;
use Illuminate\Foundation\Http\FormRequest;

class WriteKidRequest extends AbilityBasedRequest
{
    // NOTE(ex4): Add abilities
    public function getAbilities(): array
    {
        return ["*"];
    }
}
