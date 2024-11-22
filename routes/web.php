<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;

Route::get('/login', [SessionController::class, 'login_post'])
    ->name('login');


Route::get('/', function () {
    return view('login');
})->name('loginindex');

Route::get('/adminindex', function () {
    return view('admin/index');
})->name('admin');


Route::get('/logout', [SessionController::class, 'destroy'])
    ->name('login.destroy');



Route::get('/adminindex', [AdminController::class, 'list'])->name('list');

Route::post('/adminindex/edit/{id}', [AdminController::class, 'update'])->name('edit');

Route::get('/adminindex/create', [AdminController::class, 'create'])->name('create');

Route::get('/adminindex/delete/{id}/{name}', [AdminController::class, 'delete'])->name('delete');

Route::get('/adminindex/employeemonth/{id}/{name}', [AdminController::class, 'employeemonth'])->name('month');


Route::get('/index', function () {
    return view('employee/index');
})->name('employee');


Route::get('/coupons', function () {
    return view('employee/coupons');
})->name('employeecoupons');
