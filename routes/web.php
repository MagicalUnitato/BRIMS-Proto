<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChartFormController;
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

Route::get('data', [DataController::class, 'index']);

Route::get('data/list', [DataController::class, 'getData'])->name('data.list');

Route::get('/charts', [ChartController::class, 'index'])->name('charts');

Route::post('sendForm', [ChartController::class, 'chartForm']);
