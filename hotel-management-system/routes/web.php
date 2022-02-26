<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoomController;
use \App\Http\Controllers\FloorController;
use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes(['verify' => true]); //For verify Email







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
    return redirect('/login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('logout', function () {
//     return redirect('/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');


// })->middleware(['auth'])->name('dashboard');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {


// });

Route::prefix('admin')->group(function () {
    //get form
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
});
Route::prefix('admin')->group(function(){


Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
// Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');



 });



Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');


Route::get('/hotel', function () {
    return view('dashboard.layout.master');
})->middleware(['admin'],['auth'],['manager'])->name('hotel');


Route::prefix('client')->group(function () {

    //get form
    Route::get('/login', [ClientController::class, 'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ClientController::class, 'Login'])->name('client.login');
    // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');

});


Route::prefix('receptionist')->group(function () {

    //get form
    Route::get('/login', [ReceptionistController::class, 'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ReceptionistController::class, 'Login'])->name('receptionist.login');
    // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');


});


// ===============================================================================================
// Client
Route::get('/dashboard/clients', [ClientController::class, 'index'])->middleware(['client'])->name('client.index');
Route::get('/dashboard/clients/manage', [ClientController::class, 'showUnapproved'])->middleware(['client'])->name('client.manage');
// Route::post('/dashboard/clients/approve/{id}', [ClientController::class, 'approve'])->middleware(['client'])->name('client.approve');
Route::post('/dashboard/clients/reject/{id}', [ClientController::class, 'reject'])->middleware(['client'])->name('client.reject');
// Route::get('/dashboard/clients/approved', [ClientController::class, 'showApproved'])->middleware(['client'])->name('client.approved');
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


Route::post('/dashboard/clients/store', [ClientController::class, 'store'])->middleware(['client'])->name('client.store');
Route::get('/dashboard/clients/create', [ClientController::class, 'create'])->middleware(['client'])->name('client.create');
Route::post('/dashboard/clients/edit/{id}', [ClientController::class, 'edit'])->middleware(['client'])->name('client.edit');
Route::get('/dashboard/clients/update/{id}', [ClientController::class, 'update'])->middleware(['client'])->name('client.update');
Route::delete('/dashboard/clients/delete/{id}', [ClientController::class, 'destroy'])->middleware(['client'])->name('client.delete');
Route::get('/dashboard/clients/{id}', [ClientController::class, 'show'])->middleware(['client'])->name('client.show');
// ===============================================================================================
// Reservation
Route::get('/dashboard/reservations', [ReservationController::class, 'index'])->name('reservation.index');

Route::get('/dashboard/reservations/manage', [ReservationController::class, 'showUnapproved'])->name('reservation.manage');
Route::post('/dashboard/reservations/approve/{id}', [ReservationController::class, 'approve'])->name('reservation.approve');
Route::post('/dashboard/reservations/reject/{id}', [ReservationController::class, 'reject'])->name('reservation.reject');
Route::get('/dashboard/reservations/approved', [ReservationController::class, 'showApproved'])->name('reservation.approved');

Route::get('/dashboard/client-reservations', [ReservationController::class, 'showAll'])->name('reservation.clientReservations');
Route::get('/dashboard/show-reservations', [ReservationController::class, 'showAllforAdmin'])->name('reservation.showReservations');

Route::get('/dashboard/avail-rooms', [RoomController::class,'showAvail'])->name('room.showAvail');
Route::get('/dashboard/reservations/rooms/{roomId}', [ReservationController::class,'create'])->name('room.reserve');
Route::post('/dashboard/make-reservation/{roomId}', [ReservationController::class,'store'])->name('reservation.make');
Route::post('/dashboard/reservations/store', [ReservationController::class,'store'])->name('reservation.store');
Route::get('/dashboard/reservations/create', [ReservationController::class,'create'])->name('reservation.create');
Route::post('/dashboard/reservations/edit/{id}',[ReservationController::class, 'edit'])->name('reservation.edit');
Route::post('/dashboard/reservations/update/{id}',[ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/dashboard/reservations/delete/{id}',[ReservationController::class, 'destroy'])->name('reservation.delete');
Route::get('/dashboard/reservations/{id}', [ReservationController::class,'show'])->name('reservation.show');

Route::post('/dashboard/reservations/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
Route::post('/dashboard/reservations/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/dashboard/reservations/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
Route::get('/dashboard/reservations/{id}', [ReservationController::class, 'show'])->name('reservation.show');
// ===============================================================================================














// index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['auth'])->name('manager.index');
// show managere
Route::get('manager/{id}', [ManagerController::class, 'show'])->name('manager.show');
// crete
Route::get('manager/create', [ManagerController::class, 'create'])->middleware(['auth'])->name('manager.create');
Route::post('manager/store', [ManagerController::class, 'store'])->middleware(['auth'])->name('manager.store');
//manager login
//get form
Route::get('/manager/login', [ManagerController::class, 'loginForm'])->name('loginManager.form');
//check
Route::post('/manager/login/owner', [ManagerController::class, 'Login'])->name('manager.login');
//manager logout
// Route::get('manager/logout', [ManagerController::class, 'logout'])->name('manager.logout')->middleware('manager');

//index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['admin'])->name('manager.index');
//show manager
//create
Route::get('manager/create', [ManagerController::class, 'create'])->middleware(['admin'])->name('manager.create');
Route::post('manager/store', [ManagerController::class, 'store'])->middleware(['admin'])->name('manager.store');
//update
Route::get('manager/edit/{id}', [ManagerController::class, 'edit'])->middleware(['admin'])->name('manager.edit');
Route::post('manager/update/{id}', [ManagerController::class, 'update'])->middleware(['admin'])->name('manager.update');
//Delete
Route::delete('manager/delete/{id}', [ManagerController::class, 'destroy'])->middleware(['admin'])->name('admin.delete');

////////////////////////////////rooms
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::get('room/create', [RoomController::class, 'create'])->name('room.create');
Route::post('room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('room/edit/{id}', [RoomController::class, 'edit'])->name('room.edit');
Route::post('room/update/{id}', [RoomController::class, 'update'])->name('room.update');
Route::delete('room/delete/{id}', [RoomController::class, 'destroy'])->name('room.delete');
Route::delete('manager/delete/{id}', [ManagerController::class, 'destroy'])->middleware(['auth'])->name('manager.delete');



//index managere
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.index');
//show managere
// Route::get('manager/{id}',[ManagerController::class, 'show'])->name('manager.show');
//crete
Route::get('admin/create', [AdminController::class, 'create'])->middleware(['auth'])->name('admin.create');
Route::post('admin/store', [AdminController::class, 'store'])->middleware(['auth'])->name('admin.store');
//update
Route::get('admin/edit/{id}', [AdminController::class, 'edit'])->middleware(['auth'])->name('admin.edit');
Route::post('admin/update/{id}', [AdminController::class, 'update'])->middleware(['auth'])->name('admin.update');
//Delete
Route::delete('admin/delete/{id}', [AdminController::class, 'destroy'])->middleware(['auth'])->name('admin.delete');



//middleware(['receptionist'])->
Route::get('/dashboard/receptionists/', [ReceptionistController::class, 'index'])->name('dashboard.receptionist.index');

Route::get('/dashboard/receptionists/create', [ReceptionistController::class, 'create']);
Route::post('/dashboard/receptionists/store', [ReceptionistController::class, 'store'])->name('dashboard.receptionist.store');
Route::delete('/delete/{id}', [ReceptionistController::class, 'destroy'])->name('receptionist.delete');
Route::get('/editrecp/{id}', [ReceptionistController::class, 'edit'])->name('dashboard.receptionist.edit');
Route::post('/saveEditrecp/{id}', [ReceptionistController::class, 'update'])->name('dashboard.receptionist.update');
Route::get('/show/{id}', [ReceptionistController::class, 'show'])->name('dashboard.receptionist.show');



Route::get('/dashboard/receptionists/approve', [ReceptionistController::class, 'index'])->name('dashboard.receptionist.approve');

Route::post('/force-logout', [ReceptionistController::class, 'forcelogout']);




Route::get('/dashboard/floors/', [FloorController::class, 'index'])->name('dashboard.floor.index');
Route::get('/dashboard/floors/create', [FloorController::class, 'create']);
Route::post('/dashboard/floors/store', [FloorController::class, 'store'])->name('dashboard.floor.store');
Route::delete('/destroy/{id}', [FloorController::class, 'destroy'])->name('floor.delete');
Route::get('/edit/{id}', [FloorController::class, 'edit'])->name('dashboard.floor.edit');
Route::post('/saveEdit/{id}', [FloorController::class, 'update'])->name('dashboard.floor.update');
Route::get('/show/{id}', [FloorController::class, 'show'])->name('dashboard.floor.show');











require __DIR__ . '/auth.php';
