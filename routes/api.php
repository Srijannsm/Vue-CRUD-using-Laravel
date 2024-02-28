<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get json data for students
Route::get('student_details', [StudentController::class,'index']);

//store new student data
Route::post('student/store', [StudentController::class,'store']);

//edit student data
Route::post('student/{id}/edit', [StudentController::class,'edit']);

//show specific student data
Route::get('student/{id}/show', [StudentController::class,'show']);

//delete specific student data
Route::delete('student/{id}/delete', [StudentController::class,'delete']);
