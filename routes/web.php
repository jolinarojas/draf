<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseholdController;
 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
 
Route::get('ajax-crud-datatable', [HouseholdController::class, 'index']);
Route::post('store', [HouseholdController::class, 'store']);
Route::post('edit', [HouseholdController::class, 'edit']);
Route::post('delete', [HouseholdController::class, 'destroy']);

