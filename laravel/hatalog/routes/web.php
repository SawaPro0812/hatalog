<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\SessionManageController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TOP画面表示
Route::get('/', [TopController::class, 'index'])->name('top.index');
// ユーザ新規登録画面表示
Route::get('/register', [RegisteredUserController::class, 'create'])->name('registrer.create');
// ユーザ新規登録処理
Route::post('/register/create', [RegisteredUserController::class, 'store'])->name('registrer.store');
// ヘルプ画面表示
Route::get('/help', [TopController::class, 'index'])->name('top.index');
// 勤務履歴確認画面
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');


// API
Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
    Route::post('/session/start', [SessionManageController::class, 'start'])->name('session.start');
    Route::post('/session/end', [SessionManageController::class, 'end'])->name('session.end');
});

require __DIR__.'/auth.php';
