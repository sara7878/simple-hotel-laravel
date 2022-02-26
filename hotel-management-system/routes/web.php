<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes(['verify' => true]); //For verify Email


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
    return redirect('/login');
});

// Route::get('logout', function () {
//     return redirect('/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');


// })->middleware(['auth'])->name('dashboard');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {


// });



Route::get('/hotel', function () {
    return view('dashboard.layout.master');
})->name('hotel');

// Route::get('/hotel', function () {
//     return view('dashboard.layout.master');
// })->middleware(['admin'],['auth'],['manager'])->name('hotel');


Route::prefix('receptionist')->group(function(){
    
    //get form
    Route::get('/login',[ReceptionistController::class,'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ReceptionistController::class, 'Login'])->name('receptionist.login');
    // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
    
    });




//manager login
    //get form
Route::get('/manager/login',[ManagerController::class,'loginForm'])->name('loginManager.form');
    //check
Route::post('/manager/login/owner', [ManagerController::class, 'Login'])->name('manager.login');
//manager logout
// Route::get('manager/logout', [ManagerController::class, 'logout'])->name('manager.logout')->middleware('manager');
//index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['admin'])->name('manager.index');
//show manager
//create
Route::get('manager/create',[ManagerController::class, 'create'])->middleware(['admin'])->name('manager.create');
Route::post('manager/store',[ManagerController::class, 'store'])->middleware(['admin'])->name('manager.store');
//update
Route::get('manager/edit/{id}',[ManagerController::class, 'edit'])->middleware(['admin'])->name('manager.edit');
Route::post('manager/update/{id}',[ManagerController::class, 'update'])->middleware(['admin'])->name('manager.update');
//Delete
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->middleware(['admin'])->name('admin.delete');

////////////////////////////////rooms
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::get('room/create',[RoomController::class, 'create'])->name('room.create');
Route::post('room/store',[RoomController::class, 'store'])->name('room.store');
Route::get('room/edit/{id}',[RoomController::class, 'edit'])->name('room.edit');
Route::post('room/update/{id}',[RoomController::class, 'update'])->name('room.update');
Route::delete('room/delete/{id}',[RoomController::class, 'destroy'])->name('room.delete');
Route::delete('manager/delete/{id}',[ManagerController::class, 'destroy'])->middleware(['auth'])->name('manager.delete');




Route::prefix('admin')->group(function(){
    //get form
    Route::get('login',[AdminController::class,'loginForm'])->name('login.form');
    //check
    Route::post('login/owner', [AdminController::class, 'Login'])->name('admin.login');
});
//index managere
Route::get('/admin', [AdminController::class, 'index'])->middleware(['admin'])->name('admin.index');
//show managere
// Route::get('manager/{id}',[ManagerController::class, 'show'])->name('manager.show');
//crete
Route::get('admin/create',[AdminController::class, 'create'])->middleware(['manager'])->name('admin.create');
Route::post('admin/store',[AdminController::class, 'store'])->middleware(['manager'])->name('admin.store');
//update
Route::get('admin/edit/{id}',[AdminController::class, 'edit'])->middleware(['admin'])->name('admin.edit');
Route::post('admin/update/{id}',[AdminController::class, 'update'])->middleware(['admin'])->name('admin.update');
//Delete
Route::delete('admin/delete/{id}',[AdminController::class, 'destroy'])->middleware(['admin'])->name('admin.delete');


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



Route::get('/dashboard/receptionists/approve',[ReceptionistController::class, 'index'])->middleware(['receptionist'])->name('dashboard.receptionist.approve');





Route::get('/dashboard/floors/',[FloorController::class, 'index'])->middleware(['receptionist'])->name('dashboard.floor.index');
Route::get('/dashboard/floors/create',[FloorController::class, 'create']);
Route::post('/dashboard/floors/store',[FloorController::class, 'store'])->name('dashboard.floor.store');
Route::delete('/destroy/{id}',[FloorController::class, 'destroy'])->name('floor.delete');
Route::get('/edit/{id}',[FloorController::class, 'edit'])->name('dashboard.floor.edit');
Route::post('/saveEdit/{id}',[FloorController::class, 'update'])->name('dashboard.floor.update');
Route::get('/show/{id}',[FloorController::class, 'show'])->name('dashboard.floor.show');
