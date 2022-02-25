<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
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


// Route::prefix('admin')->group(function(){

//get form
Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
// Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');



// });



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

// Route::get('admin/dashboard', function () {
//     return view('backend.dashboard');
// })->middleware(['auth:admin'])->name('admin.dashboard');

// Route::get('/admin-register', [RegisteredUserController::class, 'create'])
//     ->middleware('guest:admin')
//     ->name('admin.register');

// Route::post('/admin-register', [RegisteredUserController::class, 'store'])
//     ->middleware('guest:admin');

// Route::get('/admin-login', [AuthenticatedSessionController::class, 'create'])
//     ->middleware('guest:admin')
//     ->name('admin.login');

// Route::post('/admin-login', [AuthenticatedSessionController::class, 'store'])
//     ->middleware('guest:admin');
// Route::post('/admin-logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('admin.logout')
//     ->middleware('auth:admin');



Route::get('/dashboard/clients', [ClientController::class,'index'])->middleware(['client'])->name('client.index');
Route::post('/dashboard/clients/store', [ClientController::class,'store'])->middleware(['client'])->name('client.store');
Route::get('/dashboard/clients/create', [ClientController::class,'create'])->middleware(['client'])->name('client.create');
Route::post('/dashboard/clients/edit/{id}',[ClientController::class, 'edit'])->middleware(['client'])->name('client.edit');
Route::get('/dashboard/clients/update/{id}',[ClientController::class, 'update'])->middleware(['client'])->name('client.update');
Route::delete('/dashboard/clients/delete/{id}',[ClientController::class, 'destroy'])->middleware(['client'])->name('client.delete');
Route::get('/dashboard/clients/{id}', [ClientController::class,'show'])->middleware(['client'])->name('client.show');

Route::get('/dashboard/reservations', [ReservationController::class,'index'])->name('reservation.index');
Route::get('/dashboard/client-reservations', [ReservationController::class,'showAll'])->name('reservation.clientReservations');
Route::get('/dashboard/show-reservations', [ReservationController::class,'showAllforAdmin'])->name('reservation.showReservations');

Route::post('/dashboard/reservations/store', [ReservationController::class,'store'])->name('reservation.store');
//////needs modification
//////url should be : /reservations/rooms/{roomId}
// Route::get('/dashboard/reservations/rooms/{roomId}', [ReservationController::class,'create'])->name('reservation.create');
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
//login
// Route::get('manager/loginManager/',[ManagerController::class, 'loginManager '])->name('manager.login');
// Route::post('manager/login/',[ManagerController::class, 'auth '])->name('manager.auth');


require __DIR__.'/auth.php';






