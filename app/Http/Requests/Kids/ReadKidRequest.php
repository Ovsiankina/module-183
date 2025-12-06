<?php

namespace App\Http\Requests\Kids;


use App\Http\Requests\AbilityBasedRequest;

class ReadKidRequest extends AbilityBasedRequest
{
    // NOTE(ex4): Add abilities
    public function getAbilities(): array
    {
        // NOTE(ex5): Add kids:read:unwise ability
        return ["*", "kids:list", "kids:read:unwise"];
    }
}
