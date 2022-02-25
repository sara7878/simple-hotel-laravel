<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applimanagerion. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//crad manageregory

Route::get('/dashboard/clients', [ClientController::class,'index'])->name('client.index');
Route::post('/dashboard/clients/store', [ClientController::class,'store'])->name('client.store');
Route::get('/dashboard/clients/create', [ClientController::class,'create'])->name('client.create');
Route::post('/dashboard/clients/edit/{id}',[ClientController::class, 'edit'])->name('client.edit');
Route::get('/dashboard/clients/update/{id}',[ClientController::class, 'update'])->name('client.update');
Route::delete('/dashboard/clients/delete/{id}',[ClientController::class, 'destroy'])->name('client.delete');
Route::get('/dashboard/clients/{id}', [ClientController::class,'show'])->name('client.show');

Route::get('/dashboard/reservations', [ReservationController::class,'index'])->name('reservation.index');
Route::post('/dashboard/reservations/store', [ReservationController::class,'store'])->name('reservation.store');
//////needs modification
//////url should be : /reservations/rooms/{roomId}
Route::get('/dashboard/reservations/rooms/{roomId}', [ReservationController::class,'create'])->name('reservation.create');
Route::get('/dashboard/reservations/create', [ReservationController::class,'create'])->name('reservation.create');
Route::post('/dashboard/reservations/edit/{id}',[ReservationController::class, 'edit'])->name('reservation.edit');
Route::post('/dashboard/reservations/update/{id}',[ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/dashboard/reservations/delete/{id}',[ReservationController::class, 'destroy'])->name('reservation.delete');
Route::get('/dashboard/reservations/{id}', [ReservationController::class,'show'])->name('reservation.show');


//index managere
Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
//show managere
// Route::get('manager/{id}',[ManagerController::class, 'show'])->name('manager.show');
//crete
Route::get('manager/create',[ManagerController::class, 'create'])->name('manager.create');
Route::post('manager/store',[ManagerController::class, 'store'])->name('manager.store');
//update
Route::get('manager/edit/{id}',[ManagerController::class, 'edit'])->name('manager.edit');
Route::post('manager/update/{id}',[ManagerController::class, 'update'])->name('manager.update');

//Delete
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->name('manager.delete');
