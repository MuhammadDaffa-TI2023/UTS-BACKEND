<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/employees', [EmployeesController::class, 'index']);
Route::post('/employees', [EmployeesController::class, 'store']);
Route::put('/employees/{id}', [EmployeesController::class, 'update']);
Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);
Route::get('/employees/{id}', [EmployeesController::class, 'show']);


 Route::post('/register', [AuthController::class, 'register']);
 Route::post('/login', [AuthController::class,'login']);