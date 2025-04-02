<?php

use App\Http\Controllers\SummaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SummaryController::class, 'index']);
Route::post('/api/summary', [SummaryController::class, 'generate'])->middleware('api')->name('summary.generate');
