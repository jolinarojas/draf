<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\FamilyMemberController;
 
Route::get('/dashboard', function () {
    return view('dashboard');
});
 
Route::get('viewhousehold', [HouseholdController::class, 'viewhousehold']);
Route::get('/', [HouseholdController::class, 'index']);
Route::post('store', [HouseholdController::class, 'store']);
Route::post('edit', [HouseholdController::class, 'edit']);
Route::post('delete', [HouseholdController::class, 'destroy']);

Route::resource('family-members', FamilyMemberController::class);

