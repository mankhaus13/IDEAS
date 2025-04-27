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

Route::get('/', function () {
    return view('welcome');
});

// TT
Route::get('/tt', [\App\Http\Controllers\TechnicalTaskController::class, 'index'])->name('tt.index');

// PROJECT
Route::get('/project', [\App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');

// RESOURCE
Route::get('/resource', [\App\Http\Controllers\ResourceController::class, 'index'])->name('resource.index');

// DOCUMENT_FLOW
Route::get('/document-flow', [\App\Http\Controllers\DocumentFlowController::class, 'index'])->name('document-flow.index');

// PROTOTYPING
Route::get('/prototype', [\App\Http\Controllers\PrototypingController::class, 'index'])->name('prototype.index');

// ANALYTICS
Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');


