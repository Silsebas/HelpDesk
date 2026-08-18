<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

Route::get('/', [RequestController::class, 'index'])->name('requests.index');
Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
Route::get('/requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');
Route::delete('/requests/{request}', [RequestController::class, 'destroy'])->name('requests.destroy');