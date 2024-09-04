<?php

use App\Http\Controllers\Admin\DefectCodeController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ServiceWorksController;
use App\Http\Controllers\Admin\SparePartsController;
use App\Http\Controllers\Admin\SymptomCodeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\v1\TokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Crm\SearchServiceWorksController;
use App\Http\Controllers\Crm\SearchSparePartsController;
use App\Http\Controllers\Crm\TechnicalConclusionsController;
use App\Http\Controllers\Crm\WarrantyClaimsController;
use App\Http\Controllers\ImportCatalogsController;
use App\Http\Controllers\ImportExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.auth.login');
})->middleware('guest')->name('home');

Route::get('import-excel', [ImportExcelController::class, 'import']);
Route::get('import-sql', [ImportCatalogsController::class, 'import']);
Route::post('token', TokenController::class)->prefix('api/v1');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/users', UserController::class);
    Route::resource('/defect-codes', DefectCodeController::class);
    Route::resource('/symptom-codes', SymptomCodeController::class);
    Route::resource('/works', ServiceWorksController::class);
    Route::resource('/parts', SparePartsController::class);
});

Route::middleware('guest')->prefix('crm')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('crm.login');
});
Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'crm'], function () {
    Route::resource('/warranty', WarrantyClaimsController::class);
    Route::resource('/ate', TechnicalConclusionsController::class);

    Route::get('/search_spareparts', SearchSparePartsController::class)->name('search_spareparts');
    Route::get('/search_serviceworks', SearchServiceWorksController::class)->name('search_serviceworks');
});
