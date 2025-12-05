<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kid extends Model
{
    use HasFactory;

    public const WISE_LEVEL_1 = "Très sage";
    public const WISE_LEVEL_2 = "Sage la plupart du temps";
    public const WISE_LEVEL_3 = "Un peu casse bonbon";
    public const WISE_LEVEL_4 = "Un vrai petit mer****";

    protected $fillable = [
        'name',
        'birthDate',
        'address',
        'zipCode',
        'city',
        'wishList',
        'wiseLevel'
    ];
}
