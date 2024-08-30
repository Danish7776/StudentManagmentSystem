<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

//PUBLIC ROUTES
Route::post('/loginUser', [UserController::class, 'login'])->name('loginUser');
Route::post('/registerUser', [UserController::class, 'signup'])->name('registerUser');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/SignIn', function () {
    return view('login');
})->name('SignIn');

Route::get('/SignUp', function () {
    return view('signup');
})->name('SignUp');

//PROTECTED ROUTES
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('Dashboard-Teacher', [StudentController::class, 'index']);
    Route::post('student', [StudentController::class, 'store']);
    Route::get('fetch-student', [StudentController::class, 'fetchStudents']);
    Route::get('edit-student/{id}', [StudentController::class, 'edit']);
    Route::put('update-student/{id}', [StudentController::class, 'update']);
    Route::delete('delete-student/{id}', [StudentController::class, 'destroy']);

});

?>