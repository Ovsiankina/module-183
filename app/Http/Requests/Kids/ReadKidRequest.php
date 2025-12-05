<?php

namespace App\Http\Requests\Kids;


use App\Http\Requests\AbilityBasedRequest;

class ReadKidRequest extends AbilityBasedRequest
{
    public function getAbilities(): array
    {
        return ["*", "kids:list"];
    }
}
