<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');


// })->middleware(['auth'])->name('dashboard');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {


// });






Route::prefix('admin')->group(function(){
    
//get form
Route::get('/login',[AdminController::class,'loginForm'])->name('login.form');
//check
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
// Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');


});

Route::get('/home', function () {
    return view('dashboard.layout.master');
})->middleware(['auth'])->name('dashboard');



Route::prefix('receptionist')->group(function(){
    
    //get form
    Route::get('/login',[ReceptionistController::class,'loginForm'])->name('login.form');
    //check
    Route::post('/login/owner', [ReceptionistController::class, 'Login'])->name('receptionist.login');
    // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
    
    
    });




    // Route::get('/recptionist/home', function () {
    //     return view('dashboard.layout.master');
    // })->middleware(['auth'])->name('dashboard');
    










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



//index managere
Route::get('/manager', [ManagerController::class, 'index'])->middleware(['auth'])->name('manager.index');
//show managere
// Route::get('manager/{id}',[ManagerController::class, 'show'])->name('manager.show');
//crete
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






//middleware(['receptionist'])->
Route::get('/dashboard/receptionists/',[ReceptionistController::class, 'index'])->middleware(['receptionist'])->name('dashboard.receptionist.index');

Route::get('/dashboard/receptionists/create',[ReceptionistController::class, 'create']);
Route::post('/dashboard/receptionists/store',[ReceptionistController::class, 'store'])->name('dashboard.receptionist.store');
Route::delete('/delete/{id}', [ReceptionistController::class, 'destroy'])->name('receptionist.delete');
Route::get('/editrecp/{id}', [ReceptionistController::class, 'edit'])->name('dashboard.receptionist.edit');
Route::post('/saveEditrecp/{id}', [ReceptionistController::class, 'update'])->name('dashboard.receptionist.update');
Route::get('/show/{id}', [ReceptionistController::class, 'show'])->name('dashboard.receptionist.show');



Route::get('/dashboard/floors/',[FloorController::class, 'index'])->middleware(['receptionist'])->name('dashboard.floor.index');
Route::get('/dashboard/floors/create',[FloorController::class, 'create']);
Route::post('/dashboard/floors/store',[FloorController::class, 'store'])->name('dashboard.floor.store');
Route::delete('/destroy/{id}',[FloorController::class, 'destroy'])->name('floor.delete');
Route::get('/edit/{id}',[FloorController::class, 'edit'])->name('dashboard.floor.edit');
Route::post('/saveEdit/{id}',[FloorController::class, 'update'])->name('dashboard.floor.update');
Route::get('/show/{id}',[FloorController::class, 'show'])->name('dashboard.floor.show');
