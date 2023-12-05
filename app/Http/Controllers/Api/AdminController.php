<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

use function Laravel\Prompts\table;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showDashboard()
    {

        if (Auth::check()) {
            // User is authenticated, proceed with fetching data
            $students = Student::orderBy('id', 'desc')->paginate(10);

            return view('admin.dashboard', compact('students'));
        }

        // User is not authenticated, redirect to login page
        return redirect()->route('auth.login');
    }

    public function search($query)
    {
        // return $query;
        $students = Student::where('first_name', 'LIKE', "%$query%")
            ->orWhere('last_name', 'LIKE', "%$query%")
            ->orWhere('middle_name', 'LIKE', "%$query%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.student-list', compact('students'));
    }

    public function getStudentList()
    {
        $students = Student::orderBy('id', 'desc')->paginate(10);

        return view('admin.student-list', compact('students'));
    }
    public function registerStudent(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'middle_name' => 'required',
                'student_id' => 'required',
            ]);

            Student::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'student_id' => $request->student_id
            ]);
            return response(['msg', 'Student registered successfully'], 200);
        } catch (ValidationException $e) {
            return response(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response(['error' => 'Something went wrong. Please try again.', 'msg' => $e->getMessage()], 500);
        }
    }

    public function getStudentById($id)
    {
        try {
            $student = Student::where('id', $id)->first();
            return response(['data' => $student], 200);
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }

    public function updateStudent(Request $request)
    {
        try {
            $student = DB::table('students')->find($request->id);

            if (!$student) {
                return response(['error' => 'Student not found.'], 404);
            }

            DB::table('students')->where('id', $request->id)->update([
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name
            ]);
            return response(['msg' => "Student updated successfully"], 200);
        } catch (ValidationException $e) {
            return response(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response(['error' => 'Something went wrong. Please try again.', 'msg' => $e->getMessage()], 500);
        }
    }

    public function attendanceCheck(Request $request)
    {
   
        try {
            foreach ($request->attendance_date as $attendance) {
                Attendance::create([
                    'is_present' => $attendance->is_present,
                    'student_id' => $attendance->student_id,
                    'date' => $attendance->date,
                    'time' => $attendance->time
                ]);
                return response(['msg' => "Attendance Checked"], 200);
            }
        } catch (ValidationException $e) {
            return response(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response(['error' => 'Something went wrong. Please try again.', 'msg' => $e->getMessage()], 500);
        }
    }

    public function allStudentReportByDate($date){
        try {
            $report = DB::table('attendances')
                            ->join('students', 'attendances.student_id', 'students.id')
                            ->select('students.*', 'attendances.date', 'attendances.time')
                            ->where('')
                            ->orderBy('attendances.date', 'ASC')
                            ->get();
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }

    public function checkAttendance(Request $request){
        try {

            $demerit = 0;
            $merit = 0;
           

            if (!empty($request->attendance_demerit)) {
                $demerit = 1;
            }

            if (!empty($request->attendance_merit)) {
                $merit = 1;
            }

            if ($request->attendance_type === "0") {  //absent
                Attendance::create([
                    'student_id' => $request->student_id,
                    'date' => $request->attendance_date,
                    'time' => $request->attendance_time,
                    'is_absent' => 1,
                    'demerit' => $demerit,
                    'demerit_remarks' => $request->attendance_demerit,
                    'merit' => $merit,
                    'merit_remarks' => $request->attendance_demerit
                ]);

                return response(['msg' => "Attendance Checked"], 200);
            }

            if ($request->attendance_type === "1") { //present
                Attendance::create([
                    'is_present' => true,
                    'student_id' => $request->student_id,
                    'date' => $request->attendance_date,
                    'time' => $request->attendance_time,
                    'demerit' => $demerit,
                    'demerit_remarks' => $request->attendance_demerit,
                    'merit' => $merit,
                    'merit_remarks' => $request->attendance_demerit
                ]);

                return response(['msg' => "Attendance Checked"], 200);
            }

            if ($request->attendance_type === "2") { //Absent
                Attendance::create([
                    'is_absent' => true,
                    'student_id' => $request->student_id,
                    'date' => $request->attendance_date,
                    'time' => $request->attendance_time,
                    'demerit' => $demerit,
                    'demerit_remarks' => $request->attendance_demerit,
                    'merit' => $merit,
                    'merit_remarks' => $request->attendance_demerit
                ]);

                return response(['msg' => "Attendance Checked"], 200);
                
            }

           
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }
}
