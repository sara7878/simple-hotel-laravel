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
Route::get('/dashboard', function () {
    return view('dashboard.layout.master');
});
Route::get('/dashboard/managers', function () {
    return view('dashboard.manager.index');
});
Route::get('/dashboard/managers/create', function () {
    return view('dashboard.manager.create');
});

