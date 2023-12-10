<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Demerit;
use App\Models\Merit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function studentAttendanceTrack(Request $request)
    {
        if (Auth::check()) {
            try {
                $report = DB::table('attendances')
                    ->join('students', 'attendances.student_id', 'students.id')
                    ->select('attendances.*', 'students.student_id as display_id', 'students.first_name', 'students.last_name', 'students.middle_name')
                    ->where('students.id', $request->track_student_id)
                    ->orderBy('attendances.date', 'DESC')
                    ->get();

                $dataArray = $report->toArray();
                $pdf = new PDF();
                $pdf = PDF::LoadView('pdf.student_attendance_report', ['data' => $dataArray]);
                return $pdf->download('student_attendance_report.pdf');
                // return $report;
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
    }

    public function studentDemeritTrack(Request $request)
    {
        if (Auth::check()) {
            try {
                $report = DB::table('demerits')
                    ->join('students', 'demerits.student_id', 'students.id')
                    ->select('demerits.*', 'students.student_id as display_id', 'students.first_name', 'students.last_name', 'students.middle_name')
                    ->where('students.id', $request->demerit_student_id)
                    ->orderBy('demerits.date', 'DESC')
                    ->get();

                $dataArray = $report->toArray();
                $pdf = new PDF();
                $pdf = PDF::LoadView('pdf.student_demerit_report', ['data' => $dataArray]);
                return $pdf->download('student_demerit_report.pdf');
                // return $report;
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
    }

    public function studentMeritTrack(Request $request)
    {
        if (Auth::check()) {
            try {
                $report = DB::table('merits')
                    ->join('students', 'merits.student_id', 'students.id')
                    ->select('merits.*', 'students.student_id as display_id', 'students.first_name', 'students.last_name', 'students.middle_name')
                    ->where('students.id', $request->merit_student_id)
                    ->orderBy('merits.date', 'DESC')
                    ->get();

                $dataArray = $report->toArray();
                $pdf = new PDF();
                $pdf = PDF::LoadView('pdf.student_merit_report', ['data' => $dataArray]);
                return $pdf->download('student_merit_report.pdf');
                // return $report;
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
    }

    public function getPoints($id)
    {
        if (Auth::check()) {
            try {
                $demerit_total_points = Demerit::join('students', 'demerits.student_id', '=', 'students.id')
                    ->where('students.id', $id) // Replace $studentId with the desired student ID
                    ->sum('demerits.current_points');

                $merit_total_points = Merit::join('students', 'merits.student_id', '=', 'students.id')
                    ->where('students.id', $id) // Replace $studentId with the desired student ID
                    ->sum('merits.current_points');

                return response(['demerit_sum' => $demerit_total_points, 'merit_sum' => $merit_total_points], 200);
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
    }
}
