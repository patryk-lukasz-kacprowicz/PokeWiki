<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedPokemon extends Model
{
    protected $table = 'banned_pokemons';

    /** @var array<string>  */
    protected $fillable = [
        'name',
    ];
}
