<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QrGeneratorController;
use App\Http\Controllers\Api\ReceiptController;
use App\Http\Controllers\Api\RegisterStudentController;
use App\Http\Controllers\Api\StudentController;

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
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');

    Route::get('register-student', [RegisterStudentController::class, 'showStudenRegistration'])->name('register-student');
    Route::post('register-student-save', [RegisterStudentController::class, 'registerStudent'])->name('pubic.register');

    Route::get('registration', [AuthController::class, 'showRegistration'])->name('auth.registration');

    Route::middleware('auth')->get('admin-dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::middleware('auth')->post('merit-report-by-date', [AdminController::class, 'getMeritReportByDate'])->name('student.meritbydate');
    Route::middleware('auth')->post('demerit-report-by-date', [AdminController::class, 'getDemeritReportbyDate'])->name('student.demeritbydate');
    Route::middleware('auth')->post('student-report-by-date', [AdminController::class, 'allStudentReportByDate'])->name('student.reportbydate');

    Route::middleware('auth')->post('merit-report-by-month', [AdminController::class, 'getMeritReportByMonth'])->name('student.meritbymonth');
    Route::middleware('auth')->post('demerit-report-by-month', [AdminController::class, 'getDemeritReportbyMonth'])->name('student.demeritbymonth');
    Route::middleware('auth')->post('student-report-by-month', [AdminController::class, 'getStudentReportByMonth'])->name('student.reportbymonth');
    Route::middleware('auth')->get('grade-system', [AdminController::class, 'gradeSystem'])->name('grade.system');

    Route::middleware('auth')->post('student-attendance-report', [StudentController::class, 'studentAttendanceTrack'])->name('student.attendance');
    Route::middleware('auth')->post('student-demerit-report', [StudentController::class, 'studentDemeritTrack'])->name('student.demerit');
    Route::middleware('auth')->post('student-merit-report', [StudentController::class, 'studentMeritTrack'])->name('student.merit');

    Route::middleware('auth')->get('get-points/{id}', [StudentController::class, 'getPoints'])->name('get.points');
    Route::middleware('auth')->post('student-all-track-record', [StudentController::class, 'allTrackRecord'])->name('track.record');

    Route::post('check-attendance', [AdminController::class, 'attendanceCheck']);

    Route::get('school-activity-receipt', [ReceiptController::class, 'schoolActivityReceipt']);
    Route::get('monthly-formation-receipt/{id}', [ReceiptController::class, 'monthlyFormationReceipt'])->name('monthly.receipt');
    Route::get('merit-receipt/{id}', [ReceiptController::class, 'meritReceipt'])->name('merit.receipt');
    Route::get('demerit-receipt/{id}', [ReceiptController::class, 'demeritReceipt'])->name('demerit.receipt');

    Route::post('attendance-student-manual', [AdminController::class, 'checkAttendance'])->name('check.attendance');
    Route::post('performance-student-manual', [AdminController::class, 'gradeSystem'])->name('check.attendance');

    Route::post('grade-student-sync', [AdminController::class, 'gradeSystemSync'])->name('grade.sync');
    Route::post('attendance-student-sync', [AdminController::class, 'attendanceSync'])->name('attendance.sync');

    Route::middleware('auth:api')->group(function () {
        Route::post('add-students', [AdminController::class, 'registerStudent']);
        Route::get('generate-qrcode/{id}', [QrGeneratorController::class, 'generateQrCode']);
        Route::get('get-student-by-id/{id}', [AdminController::class, 'getStudentById']);
        Route::get('search-student/{query}', [AdminController::class, 'search']);
        Route::post('update-student', [AdminController::class, 'updateStudent']);
        Route::get('get-student-list', [AdminController::class, 'getStudentList']);
        // Route::post('attendance-student-manual', [AdminController::class, 'checkAttendance']);
        // our routes to be protected will go in here
    });
});
