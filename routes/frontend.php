<?php

use Illuminate\Support\Facades\Route;
use Laravia\Message\App\Http\Controllers\MessageController;

Route::post('/message/store', [MessageController::class, 'store'])
->name('laravia.message::store')
->middleware(['web']);
