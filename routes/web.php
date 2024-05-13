<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::resource('pets', PetController::class);


//Route::get('/pets/create', 'PetController@create')->name('pets.create');
//Route::post('/pets/{id}', 'PetController@store')->name('pets.store');
//Route::get('/pets/{id}/edit', 'PetController@edit')->name('pets.edit');
//Route::put('/pets/{id}', 'PetController@update')->name('pets.update');

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');

// Możesz też dodać inne trasy dla edycji czy pokazywania pojedynczego zwierzaka
Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');


Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');
