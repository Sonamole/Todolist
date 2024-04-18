<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/index', [MainController::class, 'list'])->name('list');
Route::post('/index/task/create', [MainController::class, 'store'])->name('todo_create');
Route::post('/index/task/{id}/update', [MainController::class, 'update'])->name('todo_update');
Route::put('/index/task/{id}/complete', [MainController::class, 'complete'])->name('todo_complete');
Route::post('/index/task/{id}/delete', [MainController::class, 'delete'])->name('todo_delete');


Route::post('/index/category/create', [MainController::class, 'category'])->name('category_create');


Route::get('/', [AuthController::class, 'index'])->name('auth_login');
Route::post('/', [AuthController::class, 'Login'])->name('auth_login');
Route::get('/register', [AuthController::class, 'registration'])->name('auth_register');
Route::post('/register', [AuthController::class, 'customRegistration'])->name('auth_register');
Route::get('signout', [AuthController::class, 'signout'])->name('signout');
