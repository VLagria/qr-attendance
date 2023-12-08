<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Demerit;
use App\Models\Merit;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Svg\Tag\Rect;

use function Laravel\Prompts\table;
use function PHPUnit\Framework\isNull;

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
                'year_level' => 'required'
            ]);

            Student::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'student_id' => $request->student_id,
                'year_lvl' => $request->year_level
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
                'middle_name' => $request->middle_name,
                'year_lvl' => $request->year_level
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

    public function indexReportStudentByDate()
    {
        return view('pdf.report_date');
    }
    public function allStudentReportByDate(Request $request)
    {
        if (Auth::check()) {
            try {
                $report = DB::table('attendances')
                    ->join('students', 'attendances.student_id', 'students.id')
                    ->select('attendances.*', 'students.student_id as display_id', 'students.first_name', 'students.last_name', 'students.middle_name')
                    ->where('attendances.date', $request->date)
                    ->orderBy('attendances.date', 'ASC')
                    ->get();

                $dataArray = $report->toArray();
                $pdf = new PDF();
                $pdf = PDF::LoadView('pdf.report_date', ['data' => $dataArray]);
                return $pdf->download('student_report_by_date.pdf');
                // return $report;
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
    }

    public function getStudentReportByMonth(Request $request)
    {
        if (Auth::check()) {
            try {
                $month = $request->month;
                $report = DB::table('attendances')
                    ->join('students', 'attendances.student_id', 'students.id')
                    ->select('attendances.*', 'students.student_id as display_id', 'students.first_name', 'students.last_name', 'students.middle_name')
                    ->whereRaw("DATE_FORMAT(attendances.date, '%Y-%m') = ?", [$month])
                    ->orderBy('attendances.date', 'ASC')
                    ->get();
                $organizedData = [];
                foreach ($report as $item) {
                    $yearMonth = date('Y-m', strtotime($item->date));
                    if (!isset($organizedData[$yearMonth])) {
                        $organizedData[$yearMonth] = [];
                    }
                    $organizedData[$yearMonth][] = $item;
                }

                $dataArray = $organizedData;
                $pdf = new PDF();
                $pdf = PDF::LoadView('pdf.report_month', ['data' => $dataArray]);
                return $pdf->download('student_report_by_month.pdf');
                // return $report;
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
    }

    public function checkAttendance(Request $request)
    {
        try {

            if ($request->attendance_type === "0") {  //absent
                $attendance = Attendance::create([
                    'description' => $request->description,
                    'is_present' => false,
                    'student_id' => $request->student_id,
                    'date' => $request->attendance_date,
                    'time' => $request->attendance_time,
                    'is_absent' => true,
                    'is_late' => false
                ]);

                

                $receiptUrl = route('monthly.receipt', ['id' => $attendance->id]);

                return response(['msg' => 'Student present', 'url' => $receiptUrl], 200);
            }

            if ($request->attendance_type === "1") { //present
                $attendance = Attendance::create([
                    'description' => $request->description,
                    'is_present' => true,
                    'student_id' => $request->student_id,
                    'date' => $request->attendance_date,
                    'time' => $request->attendance_time,
                    'is_absent' => false,
                    'is_late' => false
                ]);

                // Assuming you have a route named 'receipt.show', adjust it accordingly
                $receiptUrl = route('monthly.receipt', ['id' => $attendance->id]);

                return response(['msg' => 'Student present', 'url' => $receiptUrl], 200);
            }

            if ($request->attendance_type === "2") { //late
                $attendance = Attendance::create([
                    'description' => $request->description,
                    'is_present' => false,
                    'student_id' => $request->student_id,
                    'date' => $request->attendance_date,
                    'time' => $request->attendance_time,
                    'is_absent' => false,
                    'is_late' => true
                ]);

                $receiptUrl = route('monthly.receipt', ['id' => $attendance->id]);

                return response(['msg' => 'Student present', 'url' => $receiptUrl], 200);
            }
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }

    public function attendance_receipt($id){

    }

    public function gradeSystem(Request $request){
        try {
            // dd($request->all()); die();
            if (Auth::check()) {
                if ($request->grade_type === "Demerit") {  //Demerit
                    $points = 0;
                    $retrieve_current_points = DB::table('demerits')
                                        ->where('student_id', $request->student_id)
                                        ->where('demerits.id', 'DESC')
                                        ->first();
                    if (isNull($retrieve_current_points->previous_points) || $retrieve_current_points->previous_points === 0) {
                        $points = $request->points;
                    }else{
                        $points = $request->points + $retrieve_current_points->previous_points;
                    }
                    
                    $demerit = Demerit::create([
                        'student_id' => $request->student_id,
                        'points' => $request->points,
                        'description' => $request->grade_descriptions,
                        'date' => $request->grade_date,
                        'time' => $request->grade_time,
                        'previous_points' => $points
                    ]);
                    $receiptUrl = route('demerit.receipt', ['id' => $demerit->id]);

                    return response(['msg' => 'Student present', 'url' => $receiptUrl], 200);
                }
                if ($request->grade_type === "Merit") {  //Merit

                    $points = 0;
                    $retrieve_current_points = DB::table('merits')
                                        ->where('student_id', $request->student_id)
                                        ->where('demerits.id', 'DESC')
                                        ->first();
                    if (isNull($retrieve_current_points->previous_points) || $retrieve_current_points->previous_points === 0) {
                        $points = $request->points;
                    }else{
                        $points = $request->points + $retrieve_current_points->previous_points;
                    }
                    $merit = Merit::create([
                        'student_id' => $request->student_id,
                        'points' => $request->points,
                        'description' => $request->grade_descriptions,
                        'date' => $request->grade_date,
                        'time' => $request->grade_time,
                        'previous_points' => $points
                    ]);

                    $type = $request->grade_type;
    
                    $receiptUrl = route('merit.receipt', ['id' => $merit->id]);

                    return response(['msg' => 'Student present', 'url' => $receiptUrl], 200);
                }
            }
            return redirect()->route('auth.login');
            
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }

    public function gradeSystemSync(Request $request){
        foreach ($request->students as  $student) {
            # code...
            if ($student->grade_type === "Demerit") {  //Demerit
                Demerit::create([
                    'student_id' => $student->student_id,
                    'points' => $student->points,
                    'descriptions' => $student->grade_descriptions,
                    'date' => $student->grade_date,
                    'time' => $student->grade_time
                ]);
            }
            if ($student->grade_type === "Merit") {  //Merit
                Merit::create([
                    'student_id' => $student->student_id,
                    'points' => $student->points,
                    'descriptions' => $student->grade_descriptions,
                    'date' => $student->grade_date,
                    'time' => $student->grade_time
                ]);
            }
        }
    }

    public function attendanceSync(Request $request)
    {
        return $request->all();
        try {
            $student_list = $request->students; //naa diri tanan students
            foreach ($student_list as $student) {
                if ($student->attendance_type === "0" || $student->attendance_type === 0) { //absent
                    Attendance::create([
                        'description' => $student->description,
                        'is_present' => false,
                        'student_id' => $student->student_id,
                        'date' => $student->attendance_date,
                        'time' => $student->attendance_time,
                        'is_absent' => true,
                        'is_late' => false
                    ]);
                }

                if ($student->attendance_type === "1" || $student->attendance_type === 1) { //present
                    Attendance::create([
                        'description' => $student->description,
                        'is_present' => true,
                        'student_id' => $student->student_id,
                        'date' => $student->attendance_date,
                        'time' => $student->attendance_time,
                        'is_absent' => false,
                        'is_late' => false
                    ]);
                }

                if ($student->attendance_type === "2" || $student->attendance_type === 2) { //late
                    Attendance::create([
                        'description' => $student->description,
                        'is_present' => false,
                        'student_id' => $student->student_id,
                        'date' => $student->attendance_date,
                        'time' => $student->attendance_time,
                        'is_absent' => false,
                        'is_late' => true
                    ]);
                }  
            }
            return response(['msg' => "Attendance Sync Successfully"], 200);
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }
}
