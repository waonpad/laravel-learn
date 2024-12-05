<?php

use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    echo $invalid;

    return response()->json([
        'hello' => 'world',
    ]);
});
