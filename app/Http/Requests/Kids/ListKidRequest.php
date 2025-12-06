<?php

namespace App\Http\Requests\Kids;

use App\Http\Requests\AbilityBasedRequest;

class ListKidRequest extends AbilityBasedRequest
{
    // NOTE(ex4): Add abilities
    public function getAbilities(): array
    {
        return ["*", "kids:list"];
    }
}
