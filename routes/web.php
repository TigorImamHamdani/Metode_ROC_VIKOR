<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\InputAlternativeController;
use App\Http\Controllers\User\WeightController;
use App\Http\Controllers\User\WeightValueController;
use App\Http\Controllers\User\AlternativeValueController;
use App\Http\Controllers\User\UserRateController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ResultController;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-process', [AuthController::class, 'login'])->name('login-process');
Route::get('/register-view', [AuthController::class, 'registerView'])->name('register-view');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('user.home.index');
});

Route::get('/home', [HomeController::class, 'index'])->name('user.home.index');

// Admin Routes
Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Alternatif
    Route::get('/alternatives', [AlternativeController::class, 'index'])->name('admin.alternatives.index');
    Route::get('/alternatives/edit/{alternative}', [AlternativeController::class, 'edit'])->name('admin.alternatives.edit');
    Route::get('/alternatives/show/{alternative}', [AlternativeController::class, 'show'])->name('admin.alternatives.show');
    Route::put('/alternatives/{alternative}', [AlternativeController::class, 'update'])->name('admin.alternatives.update');
    Route::post('/alternatives-store', [AlternativeController::class, 'store'])->name('admin.alternatives.store');
    Route::delete('/alternatives/{alternative}', [AlternativeController::class, 'destroy'])->name('admin.alternatives.destroy');

    Route::get('/input-matrix', [InputAlternativeController::class, 'index'])->name('admin.input-matrix.index');
    Route::post('/alternative-values', [InputAlternativeController::class, 'store'])->name('admin.alternative-values.store');
    Route::put('/alternative-values/update/{alternative_id}', [InputAlternativeController::class, 'update'])->name('admin.alternative-values.update');

    // Kriteria
    Route::get('/criterias', [CriteriaController::class, 'index'])->name('admin.criterias.index');
    Route::get('/criterias/edit/{criteria}', [CriteriaController::class, 'edit'])->name('admin.criterias.edit');
    Route::get('/criterias/show/{criteria}', [CriteriaController::class, 'show'])->name('admin.criterias.show');
    Route::put('/criterias/{criteria}', [CriteriaController::class, 'update'])->name('admin.criterias.update');
    Route::post('/criterias-store', [CriteriaController::class, 'store'])->name('admin.criterias.store');
    Route::delete('/criterias/{criteria}', [CriteriaController::class, 'destroy'])->name('admin.criterias.destroy');
});

// User Routes
Route::prefix('user')->middleware('role:user')->group(function () {
    // Bobot
    // Route::get('/weight', [WeightController::class, 'index'])->name('user.weight.index');
    // Route::get('/weight-edit/{criteria}', [WeightController::class, 'edit'])->name('user.weight.edit');
    // Route::put('/weight-update/{criteria}', [WeightController::class, 'update'])->name('user.weight.update');
    // Route::post('/weight-store', [WeightController::class, 'store'])->name('user.weight.store');
    // Route::delete('/weight/{criteria}', [WeightController::class, 'destroy'])->name('user.weight.destroy');

    Route::get('/weight', [WeightValueController::class, 'index'])->name('user.weight.index');
    Route::get('/weight-edit/{criteria}', [WeightValueController::class, 'edit'])->name('user.weight.edit');
    Route::put('/weight-update/{criteria}', [WeightValueController::class, 'update'])->name('user.weight.update');
    Route::post('/weight-store', [WeightValueController::class, 'store'])->name('user.weight.store');
    Route::delete('/weight/{criteria}', [WeightValueController::class, 'destroy'])->name('user.weight.destroy');

    // Alternatif
    Route::get('/input-matrix', [AlternativeValueController::class, 'index'])->name('user.input-matrix.index');
    Route::post('/alternative-values', [AlternativeValueController::class, 'store'])->name('user.alternative-values.store');
    Route::get('/alternative-values/edit/{alternative_id}', [AlternativeValueController::class, 'edit'])->name('user.alternative-values.edit');
    Route::put('/alternative-values/update/{alternative_id}', [AlternativeValueController::class, 'update'])->name('user.alternative-values.update');
    Route::delete('/alternative-values/{alternative_id}', [AlternativeValueController::class, 'destroy'])->name('user.alternative-values.destroy');

    // Rate

    Route::post('/alternative-values', [UserRateController::class, 'store'])->name('user.alternative-values.store');
    Route::get('/alternative-values/edit/{alternative_id}', [UserRateController::class, 'edit'])->name('user.alternative-values.edit');
    Route::put('/alternative-values/update/{alternative_id}', [UserRateController::class, 'update'])->name('user.alternative-values.update');

    // Hasil
    Route::get('/normalization-matrix', [ResultController::class, 'index'])->name('user.normalization-matrix.index');
    Route::get('/normalization-weight', [ResultController::class, 'normalization_weight'])->name('user.normalization-weight.index');
    Route::get('/value-result', [ResultController::class, 'value_result'])->name('user.value-result.index');
    Route::get('/result', [ResultController::class, 'index'])->name('user.result.index');

    Route::get('/check-rankings', [HomeController::class, 'checkRankings'])->name('check.rankings');

});
