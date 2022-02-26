<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ManagerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');


// })->middleware(['auth'])->name('dashboard');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {


// });

Route::get('/home', function () {
    return view('dashboard.layout.master');
    })->name('dashboard');


Route::prefix('admin')->group(function(){

//get form
Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
// Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');



});

// Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');

//index managere
Route::get('/admin', [AdminController::class, 'index'])->middleware(['admin'])->name('admin.index');
Route::get('admin/create',[AdminController::class, 'create'])->middleware(['admin'])->name('admin.create');
Route::post('admin/store',[AdminController::class, 'store'])->middleware(['admin'])->name('admin.store');
//update
Route::get('admin/edit/{id}',[AdminController::class, 'edit'])->middleware(['admin'])->name('admin.edit');
Route::post('admin/update/{id}',[AdminController::class, 'update'])->middleware(['admin'])->name('admin.update');
//Delete
Route::delete('admin/delete/{id}',[AdminController::class, 'destroy'])->middleware(['admin'])->name('admin.delete');



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
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['manager'])->name('manager.index');
Route::get('manager/create',[ManagerController::class, 'create'])->middleware(['manager'])->name('manager.create');
Route::post('manager/store',[ManagerController::class, 'store'])->middleware(['manager'])->name('manager.store');
//update
Route::get('manager/edit/{id}',[ManagerController::class, 'edit'])->middleware(['manager'])->name('manager.edit');
Route::post('manager/update/{id}',[ManagerController::class, 'update'])->middleware(['manager'])->name('manager.update');
//Delete
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->middleware(['manager'])->name('manager.delete');





require __DIR__.'/auth.php';






