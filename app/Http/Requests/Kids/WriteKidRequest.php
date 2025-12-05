<?php

namespace App\Http\Requests\Kids;

use App\Http\Requests\AbilityBasedRequest;
use Illuminate\Foundation\Http\FormRequest;

class WriteKidRequest extends AbilityBasedRequest
{
    public function getAbilities(): array
    {
        return ["*"];
    }
}
