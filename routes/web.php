<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QrGeneratorController;
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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::middleware('auth')->get('admin-dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::post('check-attendance', [AdminController::class, 'attendanceCheck']);
    Route::middleware('auth:api')->group(function () {
        Route::post('add-students', [AdminController::class, 'registerStudent']);
        Route::get('generate-qrcode/{id}', [QrGeneratorController::class, 'generateQrCode']);
        Route::get('get-student-by-id/{id}', [AdminController::class, 'getStudentById']);
        Route::get('search-student/{query}', [AdminController::class, 'search']);
        Route::post('update-student', [AdminController::class, 'updateStudent']);
        Route::get('get-student-list', [AdminController::class, 'getStudentList']);
        // our routes to be protected will go in here
    });
});