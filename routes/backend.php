<?php

use Illuminate\Support\Facades\Route;
use Laravia\Message\App\Orchid\Screens\MessageEditScreen;
use Laravia\Message\App\Orchid\Screens\MessageScreen;
use Tabuna\Breadcrumbs\Trail;

$prefix = config('platform.prefix');

Route::middleware(['web', 'auth', 'platform'])->group(function () use ($prefix) {

    Route::screen($prefix . '/messages', MessageScreen::class)
        ->name('laravia.message.list')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push('Message');
        });

    Route::screen($prefix . '/message/{message?}', MessageEditScreen::class)
        ->name('laravia.message.edit')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('laravia.message.list')
            ->push(__('Message edit or create'), route('laravia.message.list')));

});
