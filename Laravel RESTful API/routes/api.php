<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectCostController;

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


Route::get('/customers', [ProjectCostController::class, 'getCustomers']);
Route::get('/projects/{customer_id}', [ProjectCostController::class, 'getProjects']);
Route::post('/project-cost', [ProjectCostController::class, 'store']);
Route::get('/project-cost', [ProjectCostController::class, 'index']);


