<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::resource('student', StudentController::class);
Route::get('search',[StudentController::class, 'search']);
