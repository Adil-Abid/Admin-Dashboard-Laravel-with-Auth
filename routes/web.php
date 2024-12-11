<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Setup\PracticeController;
use App\Http\Controllers\Admin\UserManagement\RolesController;
use App\Http\Controllers\Admin\UserManagement\UsersController;
use App\Http\Controllers\Admin\UserManagement\PermissionController;
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

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profileIndex'])->name('profile.index');
    Route::post('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::post('/profile-update', [ProfileController::class, 'profileUpdate'])->name('profile-update');
    Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update-avatar');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');

    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/practice', [PracticeController::class, 'index'])->name('practice.index');
    Route::post('/practice', [PracticeController::class, 'store'])->name('practice.store');
    Route::get('/practice/{id}/edit', [PracticeController::class, 'edit'])->name('practice.edit');
    Route::post('/practice/{id}', [PracticeController::class, 'update'])->name('practice.update');
    Route::delete('/practice/{id}', [PracticeController::class, 'destroy'])->name('practice.destroy');

    // Route::view('/profile' , 'employee.profile');
    // Route::get('/profile', function () {
        // $employee = \App\Models\MainEmployee::find(1);
        // dd($employee);
        // $practices = SetupPractice::where('is_active', 1)->get();
        // $genders = SetupGender::all();
        // return view('employee.profile',compact('employee'));
    // });



});
