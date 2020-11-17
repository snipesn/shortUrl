<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ShortUrlController;

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

Route::view('/', 'index');

Route::get('/stat', [ShortUrlController::class, 'stat']);

Route::post('/add', [ShortUrlController::class, 'add']);

Route::get('{url}', [ShortUrlController::class, 'redirect'])->where('url','.*');
