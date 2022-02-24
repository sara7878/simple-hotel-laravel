<?php

use Illuminate\Support\Facades\Route;


use \App\Http\Controllers\FloorController;
use App\Http\Controllers\ReceptionistController;




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


Route::get('/dashboard/receptionists/',[ReceptionistController::class, 'index'])->name('dashboard.receptionist.index');

Route::get('/dashboard/receptionists/create',[ReceptionistController::class, 'create']);
Route::post('/dashboard/receptionists/store',[ReceptionistController::class, 'store'])->name('dashboard.receptionist.store');
Route::delete('/delete/{id}', [ReceptionistController::class, 'destroy'])->name('receptionist.delete');
Route::get('/edit/{id}', [ReceptionistController::class, 'edit'])->name('dashboard.receptionist.edit');
Route::post('/saveEdit/{id}', [ReceptionistController::class, 'update'])->name('dashboard.receptionist.update');
Route::get('/show/{id}', [ReceptionistController::class, 'show'])->name('dashboard.receptionist.show');



Route::get('/dashboard/floors/',[FloorController::class, 'index'])->name('dashboard.floor.index');

Route::get('/dashboard/floors/create',[FloorController::class, 'create']);
Route::post('/dashboard/floors/store',[FloorController::class, 'store'])->name('dashboard.floor.store');
//Route::delete('/delete/{id}',[FloorController::class, 'destroy'])->name('floor.delete');
Route::get('/edit/{id}',[FloorController::class, 'edit'])->name('dashboard.floor.edit');
Route::post('/saveEdit/{id}',[FloorController::class, 'update'])->name('dashboard.floor.update');
Route::get('/show/{id}',[FloorController::class, 'show'])->name('dashboard.floor.show');
