<?php

use App\Http\Controllers\v1\HouseholdController;
use App\Http\Controllers\v1\ResidentController;
use App\Http\Controllers\v1\StreetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(StreetController::class)->prefix('v1/streets/')->group(function () {
    Route::get('index', 'index')->name('streets.index');
    Route::post('store', 'store')->name('streets.store');
    Route::get('edit/{id}', 'edit')->name('streets.edit');
    Route::post('update/{id}', 'update')->name('streets.update');
    Route::delete('destroy/{id}', 'destroy')->name('streets.destroy');
    Route::get('{id}/households', 'households')->name('streets.households');
});

Route::controller(HouseholdController::class)->prefix('v1/households/')->group(function () {
    Route::post('store', 'store')->name('households.create');
    Route::get('edit/{id}', 'edit')->name('households.edit');
    Route::post('update/{id}', 'update')->name('households.update');
    Route::delete('destroy/{id}', 'destroy')->name('households.destroy');
});

Route::controller(ResidentController::class)->prefix('v1/residents/')->group(function () {
    Route::get('{id}/residents', 'residents')->name('households.residents');
    Route::post('store', 'store')->name('residents.create');
    Route::delete('destroy/{id}', 'destroy')->name('residents.destroy');
    Route::get('edit/{id}', 'edit')->name('residents.edit');
    Route::post('update/{id}', 'update')->name('residents.update');
});
