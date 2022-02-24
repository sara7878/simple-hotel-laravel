<?php

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
