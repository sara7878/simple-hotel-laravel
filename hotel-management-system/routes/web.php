<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;


use \App\Http\Controllers\FloorController;
use App\Http\Controllers\ReceptionistController;



Route::prefix('admin')->group(function(){


Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
// Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');



 });



Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');


Route::get('/home', function () {
    return view('dashboard.layout.master');
})->middleware(['admin'])->name('dashboard');


Route::prefix('client')->group(function(){

    //get form
    Route::get('/login',[ClientController::class,'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ClientController::class, 'Login'])->name('client.login');
    // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
    
    
    
    });


Route::prefix('receptionist')->group(function(){
    
    //get form
    Route::get('/login',[ReceptionistController::class,'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ReceptionistController::class, 'Login'])->name('receptionist.login');
    // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
    
    
    });




// Route::get('/dashboard/clients', [ClientController::class,'index'])->middleware(['client'])->name('client.index');
// Route::post('/dashboard/clients/store', [ClientController::class,'store'])->middleware(['client'])->name('client.store');
// Route::get('/dashboard/clients/create', [ClientController::class,'create'])->middleware(['client'])->name('client.create');
// Route::post('/dashboard/clients/edit/{id}',[ClientController::class, 'edit'])->middleware(['client'])->name('client.edit');
// Route::get('/dashboard/clients/update/{id}',[ClientController::class, 'update'])->middleware(['client'])->name('client.update');
// Route::delete('/dashboard/clients/delete/{id}',[ClientController::class, 'destroy'])->middleware(['client'])->name('client.delete');
// Route::get('/dashboard/clients/{id}', [ClientController::class,'show'])->middleware(['client'])->name('client.show');

// Route::get('/dashboard/reservations', [ReservationController::class,'index'])->name('reservation.index');
// Route::get('/dashboard/client-reservations', [ReservationController::class,'showAll'])->name('reservation.clientReservations');
// Route::get('/dashboard/show-reservations', [ReservationController::class,'showAllforAdmin'])->name('reservation.showReservations');

// Route::post('/dashboard/reservations/store', [ReservationController::class,'store'])->name('reservation.store');
// Route::get('/dashboard/reservations/create', [ReservationController::class,'create'])->name('reservation.create');
// Route::post('/dashboard/reservations/edit/{id}',[ReservationController::class, 'edit'])->name('reservation.edit');
// Route::post('/dashboard/reservations/update/{id}',[ReservationController::class, 'update'])->name('reservation.update');
// Route::delete('/dashboard/reservations/delete/{id}',[ReservationController::class, 'destroy'])->name('reservation.delete');
// Route::get('/dashboard/reservations/{id}', [ReservationController::class,'show'])->name('reservation.show');



Route::get('/dashboard/clients', [ClientController::class,'index'])->name('client.index');
Route::get('/dashboard/clients/approve', [ClientController::class,'approve'])->name('client.approve');

Route::post('/dashboard/clients/store', [ClientController::class,'store'])->name('client.store');
Route::get('/dashboard/clients/create', [ClientController::class,'create'])->name('client.create');
Route::post('/dashboard/clients/edit/{id}',[ClientController::class, 'edit'])->name('client.edit');
Route::get('/dashboard/clients/update/{id}',[ClientController::class, 'update'])->name('client.update');
Route::delete('/dashboard/clients/delete/{id}',[ClientController::class, 'destroy'])->name('client.delete');
Route::get('/dashboard/clients/{id}', [ClientController::class,'show'])->name('client.show');

Route::get('/dashboard/reservations', [ReservationController::class,'index'])->name('reservation.index');
Route::get('/dashboard/client-reservations', [ReservationController::class,'showAll'])->name('reservation.clientReservations');
Route::get('/dashboard/show-reservations', [ReservationController::class,'showAllforAdmin'])->name('reservation.showReservations');

Route::post('/dashboard/reservations/store', [ReservationController::class,'store'])->name('reservation.store');
Route::get('/dashboard/reservations/create', [ReservationController::class,'create'])->name('reservation.create');
Route::post('/dashboard/reservations/edit/{id}',[ReservationController::class, 'edit'])->name('reservation.edit');
Route::post('/dashboard/reservations/update/{id}',[ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/dashboard/reservations/delete/{id}',[ReservationController::class, 'destroy'])->name('reservation.delete');
Route::get('/dashboard/reservations/{id}', [ReservationController::class,'show'])->name('reservation.show');















// index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['auth'])->name('manager.index');
// show managere
Route::get('manager/{id}',[ManagerController::class, 'show'])->name('manager.show');
// crete
Route::get('manager/create',[ManagerController::class, 'create'])->middleware(['auth'])->name('manager.create');
Route::post('manager/store',[ManagerController::class, 'store'])->middleware(['auth'])->name('manager.store');
//update
Route::get('manager/edit/{id}',[ManagerController::class, 'edit'])->middleware(['auth'])->name('manager.edit');
Route::post('manager/update/{id}',[ManagerController::class, 'update'])->middleware(['auth'])->name('manager.update');

//Delete
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->name('manager.delete');

////////////////////////////////rooms
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::get('room/create',[RoomController::class, 'create'])->name('room.create');
Route::post('room/store',[RoomController::class, 'store'])->name('room.store');
Route::get('room/edit/{id}',[RoomController::class, 'edit'])->name('room.edit');
Route::post('room/update/{id}',[RoomController::class, 'update'])->name('room.update');
Route::delete('room/delete/{id}',[RoomController::class, 'destroy'])->name('room.delete');
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->middleware(['auth'])->name('manager.delete');



//index managere
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.index');
//show managere
// Route::get('manager/{id}',[ManagerController::class, 'show'])->name('manager.show');
//crete
Route::get('admin/create',[AdminController::class, 'create'])->middleware(['auth'])->name('admin.create');
Route::post('admin/store',[AdminController::class, 'store'])->middleware(['auth'])->name('admin.store');
//update
Route::get('admin/edit/{id}',[AdminController::class, 'edit'])->middleware(['auth'])->name('admin.edit');
Route::post('admin/update/{id}',[AdminController::class, 'update'])->middleware(['auth'])->name('admin.update');
//Delete
Route::delete('admin/delete/{id}',[AdminController::class, 'destroy'])->middleware(['auth'])->name('admin.delete');


require __DIR__.'/auth.php';






//middleware(['receptionist'])->
Route::get('/dashboard/receptionists/',[ReceptionistController::class, 'index'])->name('dashboard.receptionist.index');

Route::get('/dashboard/receptionists/create',[ReceptionistController::class, 'create']);
Route::post('/dashboard/receptionists/store',[ReceptionistController::class, 'store'])->name('dashboard.receptionist.store');
Route::delete('/delete/{id}', [ReceptionistController::class, 'destroy'])->name('receptionist.delete');
Route::get('/editrecp/{id}', [ReceptionistController::class, 'edit'])->name('dashboard.receptionist.edit');
Route::post('/saveEditrecp/{id}', [ReceptionistController::class, 'update'])->name('dashboard.receptionist.update');
Route::get('/show/{id}', [ReceptionistController::class, 'show'])->name('dashboard.receptionist.show');



Route::get('/dashboard/receptionists/approve',[ReceptionistController::class, 'index'])->name('dashboard.receptionist.approve');

Route::post('/force-logout',[ReceptionistController::class, 'forcelogout']);




Route::get('/dashboard/floors/',[FloorController::class, 'index'])->name('dashboard.floor.index');
Route::get('/dashboard/floors/create',[FloorController::class, 'create']);
Route::post('/dashboard/floors/store',[FloorController::class, 'store'])->name('dashboard.floor.store');
Route::delete('/destroy/{id}',[FloorController::class, 'destroy'])->name('floor.delete');
Route::get('/edit/{id}',[FloorController::class, 'edit'])->name('dashboard.floor.edit');
Route::post('/saveEdit/{id}',[FloorController::class, 'update'])->name('dashboard.floor.update');
Route::get('/show/{id}',[FloorController::class, 'show'])->name('dashboard.floor.show');
