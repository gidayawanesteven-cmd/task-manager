<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class)->except(['show']);
Route::patch('/tasks/{task}/status',[TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
