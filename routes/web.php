<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::resource('student', StudentController::class);
Route::get('search',[StudentController::class, 'search']);
Route::get('student/value/{nim}',[StudentController::class, 'value'])->name('student.value');
