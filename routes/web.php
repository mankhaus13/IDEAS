<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TT
Route::get('/tt/{projectId}', [\App\Http\Controllers\TechnicalTaskController::class, 'index'])->name('tt.index');
Route::get('/tt/{projectId}/create', [\App\Http\Controllers\TechnicalTaskController::class, 'create'])->name('tt.create');
Route::get('/tt/{ttId}/edit', [\App\Http\Controllers\TechnicalTaskController::class, 'edit'])->name('tt.edit');
Route::post('/tt/{projectId}', [\App\Http\Controllers\TechnicalTaskController::class, 'store'])->name('tt.store');
Route::put('/tt/{ttId}', [\App\Http\Controllers\TechnicalTaskController::class, 'update'])->name('tt.update');
Route::delete('/tt/{ttId}', [\App\Http\Controllers\TechnicalTaskController::class, 'destroy'])->name('tt.destroy');

// PROJECT
Route::get('/project', [\App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
Route::get('/project/{id}/edit', [\App\Http\Controllers\ProjectController::class, 'edit'])->name('project.edit');
Route::get('/project/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
Route::post('/project/search', [\App\Http\Controllers\ProjectController::class, 'search'])->name('project.search');
Route::post('/project', [\App\Http\Controllers\ProjectController::class, 'store'] )->name('project.store');
Route::put('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.destroy');

// RESOURCE
Route::get('/resource', [\App\Http\Controllers\ResourceController::class, 'index'])->name('resource.index');

// DOCUMENT_FLOW
Route::get('/document-flow', [\App\Http\Controllers\DocumentFlowController::class, 'index'])->name('document-flow.index');

// PROTOTYPING
Route::get('/prototype', [\App\Http\Controllers\PrototypingController::class, 'index'])->name('prototype.index');

// ANALYTICS
Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

