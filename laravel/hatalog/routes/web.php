<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\SessionManageController;

// TOP画面表示
Route::get('/', [TopController::class, 'index'])->name('top.index');

// API
Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
    Route::post('/session/start', [SessionManageController::class, 'start'])->name('session.start');
    Route::post('/session/end', [SessionManageController::class, 'end'])->name('session.end');
});

