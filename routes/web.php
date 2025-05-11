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
Route::get('/project/{projectId}/{fileId}/delete_file', [\App\Http\Controllers\ProjectController::class, 'deleteFile'])->name('project.delete_file');
Route::post('/project/search', [\App\Http\Controllers\ProjectController::class, 'search'])->name('project.search');
Route::post('/project', [\App\Http\Controllers\ProjectController::class, 'store'] )->name('project.store');
Route::put('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.destroy');


// RESOURCE
Route::get('/resource', [\App\Http\Controllers\ResourceController::class, 'index'])->name('resource.index');
Route::get('/resource/create', [\App\Http\Controllers\ResourceController::class, 'create'])->name('resource.create');
Route::get('/resource/report', [\App\Http\Controllers\ResourceController::class, 'generateReport'])->name('resource.report');
Route::post('/resource', [\App\Http\Controllers\ResourceController::class, 'store'])->name('resource.store');

// FILE
Route::get('/file/{id}/download', [\App\Http\Controllers\FileController::class, 'download'])->name('file.download');

// PROTOTYPING
Route::get('/prototype', [\App\Http\Controllers\PrototypingController::class, 'index'])->name('prototype.index');
Route::get('/prototype/create', [\App\Http\Controllers\PrototypingController::class, 'create'])->name('prototype.create');
Route::get('/prototype/{id}/edit', [\App\Http\Controllers\PrototypingController::class, 'edit'])->name('prototype.edit');
Route::get('/prototype/report', [\App\Http\Controllers\PrototypingController::class, 'generateReport'])->name('prototype.report');
Route::post('/prototype', [\App\Http\Controllers\PrototypingController::class, 'store'])->name('prototype.store');
Route::put('/prototype/{id}', [\App\Http\Controllers\PrototypingController::class, 'update'])->name('prototype.update');
Route::delete('/prototype/{id}', [\App\Http\Controllers\PrototypingController::class, 'destroy'])->name('prototype.destroy');

// ANALYTICS
Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');
Route::get('/analytics/project_statistic', [\App\Http\Controllers\AnalyticsController::class, 'project_statistic'])->name('analytics.project_statistic');
Route::get('/analytics/employee_employment', [\App\Http\Controllers\AnalyticsController::class, 'employee_employment'])->name('analytics.employee_employment');


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

