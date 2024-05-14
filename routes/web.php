<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::resource('pets', PetController::class);

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');

Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');

Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');
