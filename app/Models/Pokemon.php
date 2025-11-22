<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    /** @var array<string>  */
    protected $fillable = [
        'pokeapi_id',
        'name',
        'pokeapi_data',
        'cached_at',
    ];

    /** @var array<string, mixed>  */
    protected $casts = [
        'cached_at' => 'datetime',
        'pokeapi_data' => 'array',
    ];
}
