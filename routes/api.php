<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\TugasApiController;
use App\Http\Controllers\Api\SpeechRecognitionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::get('tugas', [TugasApiController::class, 'all']);
Route::get('debug', [TugasApiController::class, 'debug']);
Route::get('tugas/{tugas}', [TugasApiController::class, 'get']);
Route::get('jawaban/{jawaban}', [TugasApiController::class, 'getDetail']);
Route::post('speech-recognition', [TugasApiController::class, 'speechRecognition']);
