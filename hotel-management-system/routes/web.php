<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoomController;
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

// Route::get('logout', function () {
//     return redirect('/login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');


// })->middleware(['auth'])->name('dashboard');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {


// });

//admin
Route::prefix('admin')->group(function(){
//get form
Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
});

Route::get('/hotel', function () {
    return view('dashboard.layout.master');
})->middleware(['auth'])->name('hotel');


//manager login
    //get form
Route::get('/manager/login',[ManagerController::class,'loginForm'])->name('loginManager.form');
    //check
Route::post('/manager/login/owner', [ManagerController::class, 'Login'])->name('manager.login');
//manager logout
// Route::get('manager/logout', [ManagerController::class, 'logout'])->name('manager.logout')->middleware('manager');
//index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['manager'])->name('manager.index');
//show manager
//create
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







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
