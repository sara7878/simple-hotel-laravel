<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes(['verify' => true]); //For verify Email


use \App\Http\Controllers\FloorController;
use App\Http\Controllers\ReceptionistController;



Route::get('/', function () {
    return redirect('/login');
});



Route::prefix('admin')->group(function(){
//get form
Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');


});

Route::get('/hotel', function () {
    return view('dashboard.layout.master');
})->middleware(['admin'],['auth'],['manager'],['receptionist'])->name('hotel');


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


Route::prefix('receptionist')->group(function(){

    //get form
    Route::get('/login',[ReceptionistController::class,'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ReceptionistController::class, 'Login'])->name('receptionist.login');

    });


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


//manager login
    //get form
Route::get('/manager/login',[ManagerController::class,'loginForm'])->name('loginManager.form');
    //check
Route::post('/manager/login/owner', [ManagerController::class, 'Login'])->name('manager.login');
//manager logout
//index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['manager'], ['admin'])->name('manager.index');
Route::get('manager/create',[ManagerController::class, 'create'])->middleware(['manager'],['admin'])->name('manager.create');
Route::post('manager/store',[ManagerController::class, 'store'])->middleware(['manager'],['admin'])->name('manager.store');
//update
Route::get('manager/edit/{id}',[ManagerController::class, 'edit'])->middleware(['manager'],['admin'])->name('manager.edit');
Route::post('manager/update/{id}',[ManagerController::class, 'update'])->middleware(['manager'] ,['admin'])->name('manager.update');
//Delete
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->middleware(['manager'],['admin'])->name('manager.delete');


////////////////////////////////rooms
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::get('room/create',[RoomController::class, 'create'])->name('room.create');
Route::post('room/store',[RoomController::class, 'store'])->name('room.store');
Route::get('room/edit/{id}',[RoomController::class, 'edit'])->name('room.edit');
Route::post('room/update/{id}',[RoomController::class, 'update'])->name('room.update');
Route::delete('room/delete/{id}',[RoomController::class, 'destroy'])->name('room.delete');
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->middleware(['auth'])->name('manager.delete');




require __DIR__.'/auth.php';


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//middleware(['receptionist'])->
Route::get('/dashboard/receptionists/',[ReceptionistController::class, 'index'])->middleware(['receptionist'])->name('dashboard.receptionist.index');

Route::get('/dashboard/receptionists/create',[ReceptionistController::class, 'create']);
Route::post('/dashboard/receptionists/store',[ReceptionistController::class, 'store'])->name('dashboard.receptionist.store');
Route::delete('/delete/{id}', [ReceptionistController::class, 'destroy'])->name('receptionist.delete');
Route::get('/editrecp/{id}', [ReceptionistController::class, 'edit'])->name('dashboard.receptionist.edit');
Route::post('/saveEditrecp/{id}', [ReceptionistController::class, 'update'])->name('dashboard.receptionist.update');
Route::get('/show/{id}', [ReceptionistController::class, 'show'])->name('dashboard.receptionist.show');



Route::get('/dashboard/receptionists/approve',[ReceptionistController::class, 'index'])->middleware(['receptionist'],['manager'],['admin'])->name('dashboard.receptionist.approve');



Route::get('/dashboard/floors/',[FloorController::class, 'index'])->middleware(['receptionist'],['manager'],['admin'])->name('dashboard.floor.index');
Route::get('/dashboard/floors/create',[FloorController::class, 'create'])->middleware(['receptionist'],['manager'],['admin']);
Route::post('/dashboard/floors/store',[FloorController::class, 'store'])->middleware(['receptionist'],['manager'],['admin'])->name('dashboard.floor.store');
Route::delete('/destroy/{id}',[FloorController::class, 'destroy'])->middleware(['receptionist'],['manager'],['admin'])->name('floor.delete');
Route::get('/edit/{id}',[FloorController::class, 'edit'])->middleware(['receptionist'],['manager'],['admin'])->name('dashboard.floor.edit');
Route::post('/saveEdit/{id}',[FloorController::class, 'update'])->middleware(['receptionist'],['manager'],['admin'])->name('dashboard.floor.update');
Route::get('/show/{id}',[FloorController::class, 'show'])->middleware(['receptionist'],['manager'],['admin'])->name('dashboard.floor.show');
