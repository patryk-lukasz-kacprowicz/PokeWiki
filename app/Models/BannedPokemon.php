<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedPokemon extends Model
{
    /** @var array<string>  */
    protected $fillable = [
        'name',
    ];
}
