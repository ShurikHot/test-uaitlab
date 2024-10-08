<?php

use App\Http\Controllers\Api\v1\WarrantyClaimsController;
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

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('warranty-claims', [WarrantyClaimsController::class, 'get']);
    Route::post('warranty-claims', [WarrantyClaimsController::class, 'store']);
});
