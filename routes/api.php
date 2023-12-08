<?php

use App\Http\Controllers\Api\SyncController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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
// Route::post('attendance-check', [AuthController::class, 'attendanceCheck'])->name('attendance.check');
// Route::post('attendance-student-sync', [AdminController::class, 'attendanceSync'])->name('attendance.sync');
// Route::post('grade-student-sync', [AdminController::class, 'gradeSystemSync'])->name('grade.sync');

Route::post('grade-student-sync', [SyncController::class, 'gradeSystemSync'])->name('grade.sync');
Route::post('attendance-student-sync', [SyncController::class, 'attendanceSync'])->name('attendance.sync');