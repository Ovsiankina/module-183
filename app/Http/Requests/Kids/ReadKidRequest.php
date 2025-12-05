<?php

namespace App\Http\Requests\Kids;


use App\Http\Requests\AbilityBasedRequest;

class ReadKidRequest extends AbilityBasedRequest
{
    // NOTE(ex 4): Add abilities
    public function getAbilities(): array
    {
        return ["*", "kids:list", "kids:read:unwise"];
    }
}
