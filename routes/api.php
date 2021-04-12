<?php

use App\Http\Controllers\API\StudentController;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [StudentController::class, 'index']);

Route::get('students', [StudentController::class, 'students'])->name('students');
Route::get('student/{id}', [StudentController::class, 'student'])->name('student');
// Return all facuties detail
Route::get('faculty/{id}', [StudentController::class ,'Faculty'])->name('faculty');


Route::fallback(function () {
    return response()->json(['message' => 'Page not found.'])->setStatusCode(Response::HTTP_NOT_FOUND);
});


// Auth endpoints

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});
