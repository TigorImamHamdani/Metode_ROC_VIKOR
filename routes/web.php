<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CriteriaController;

use App\Http\Controllers\User\WeightController;
use App\Http\Controllers\User\AlternativeValueController;
use App\Http\Controllers\User\ResultController;

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

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // alternatif
    Route::get('/alternatives', [AlternativeController::class, 'index'])->name('admin.alternatives.index');
    Route::get('/alternatives/edit/{alternative}', [AlternativeController::class, 'edit'])->name('admin.alternatives.edit');
    Route::put('/alternatives/{alternative}', [AlternativeController::class, 'update'])->name('admin.alternatives.update');
    Route::post('/alternatives-store', [AlternativeController::class, 'store'])->name('admin.alternatives.store');
    Route::delete('/alternatives/{alternative}', [AlternativeController::class, 'destroy'])->name('admin.alternatives.destroy');

    // kriteria
    Route::get('/criterias', [CriteriaController::class, 'index'])->name('admin.criterias.index');
    Route::get('/criterias/edit/{criteria}', [CriteriaController::class, 'edit'])->name('admin.criterias.edit');
    Route::put('/criterias/{criteria}', [CriteriaController::class, 'update'])->name('admin.criterias.update');
    Route::post('/criterias-store', [CriteriaController::class, 'store'])->name('admin.criterias.store');
    Route::delete('/criterias/{criteria}', [CriteriaController::class, 'destroy'])->name('admin.criterias.destroy');
});

Route::prefix('user')->group(function () {
    // bobot
    Route::get('/weight', [WeightController::class, 'index'])->name('user.weight.index');
    Route::get('/weight-edit/{criteria}', [WeightController::class, 'edit'])->name('user.weight.edit');
    Route::put('/weight-update/{criteria}', [WeightController::class, 'update'])->name('user.weight.update');
    Route::post('/weight-store', [WeightController::class, 'store'])->name('user.weight.store');
    Route::delete('/weight/{criteria}', [WeightController::class, 'destroy'])->name('user.weight.destroy');

    // alternatif
    Route::get('/input-matrix', [AlternativeValueController::class, 'index'])->name('user.input-matrix.index');
    Route::post('/alternative-values', [AlternativeValueController::class, 'store'])->name('user.alternative-values.store');
    Route::delete('/alternative-values/{alternative_id}', [AlternativeValueController::class, 'destroy'])->name('user.alternative-values.destroy');

    // hasil
    Route::get('/normalization-matrix', [ResultController::class, 'index'])->name('user.normalization-matrix.index');
    Route::get('/normalization-weight', [ResultController::class, 'normalization_weight'])->name('user.normalization-weight.index');
    Route::get('/value-result', [ResultController::class, 'value_result'])->name('user.value-result.index');
    Route::get('/result', [ResultController::class, 'index'])->name('user.result.index');
});


