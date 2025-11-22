<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPokemon extends Model
{
    /** @var array<string>  */
    protected $fillable = [
        'name',
        'description',
        'height',
        'weight',
        'damage',
        'type',
    ];
}
