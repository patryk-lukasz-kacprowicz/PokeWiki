<?php

use App\Http\Controllers\BannedPokemonController;
use App\Http\Controllers\PokemonInfoController;
use App\Http\Middleware\ApiSecretKeyAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('banned')
    ->middleware([ApiSecretKeyAuth::class])
    ->name('banned.')
    ->group(function () {
        Route::get('/', [BannedPokemonController::class, 'index'])->name('index');
        Route::post('/store', [BannedPokemonController::class, 'store'])->name('store');
        Route::delete('/destroy/{bannedPokemon}', [BannedPokemonController::class, 'destroy'])->name('destroy');
});

Route::get('/info', [PokemonInfoController::class, 'index'])->name('info');
