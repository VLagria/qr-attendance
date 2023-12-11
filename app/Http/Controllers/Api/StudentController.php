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
use Illuminate\Support\Collection;

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

    public function allTrackRecord(Request $request){
        try {
            if (Auth::check()) {
            try {
                $demerit_total_points = Demerit::join('students', 'demerits.student_id', '=', 'students.id')
                    ->where('students.id', $request->record_student_id) // Replace $studentId with the desired student ID
                    ->sum('demerits.current_points');

                $merit_total_points = Merit::join('students', 'merits.student_id', '=', 'students.id')
                    ->where('students.id', $request->record_student_id) // Replace $studentId with the desired student ID
                    ->sum('merits.current_points');
                
                $attendance = DB::table('attendances')
                    ->join('students', 'attendances.student_id', 'students.id')
                    ->select('attendances.*', 'students.student_id as display_id', 'students.first_name', 'students.last_name', 'students.middle_name')
                    ->where('students.id', $request->record_student_id)
                    ->orderBy('attendances.date', 'DESC')
                    ->get();
                
                $demerits = DB::table('demerits')
                    ->select('demerits.points as demerit_points',
                             'demerits.current_points as demerit_current_points',
                             'demerits.date as demerit_date',
                             'demerits.time as demerit_time',
                             'demerits.description as demerits_descriptions')
                    ->where('demerits.student_id', $request->record_student_id)
                    ->orderBy('demerits.date', 'DESC')
                    ->get();

                $merits = DB::table('merits')
                    ->select('merits.points as merit_points',
                            'merits.current_points as merit_current_points',
                            'merits.date as merit_date',
                            'merits.time as merit_time',
                            'merits.description as merits_descriptions')
                    ->where('merits.student_id', $request->record_student_id)
                    ->orderBy('merits.date', 'DESC')
                    ->get();

                // Create a collection to merge results
                $result = new Collection();

                // Merge attendance records into the collection
                $result = $result->merge($attendance);

                // Iterate through the merged result and add demerit and merit attributes to the first item
                $result->each(function ($item, $key) use ($demerits, $merits) {
                    $item->demerit_points = null;
                    $item->demerit_current_points = null;
                    $item->demerit_date = null;
                    $item->demerit_time = null;
                    $item->demerits_descriptions = null;
                    $item->merit_points = null;
                    $item->merit_current_points = null;
                    $item->merit_date = null;
                    $item->merit_time = null;
                    $item->merits_descriptions = null;

                    // Find the matching demerit record by date
                    $matchingDemerit = $demerits->where('demerit_date', $item->date)->first();
                    if ($matchingDemerit) {
                        $item->demerit_points = $matchingDemerit->demerit_points;
                        $item->demerit_current_points = $matchingDemerit->demerit_current_points;
                        $item->demerit_date = $matchingDemerit->demerit_date;
                        $item->demerit_time = $matchingDemerit->demerit_time;
                        $item->demerits_descriptions = $matchingDemerit->demerits_descriptions;
                    }

                    // Find the matching merit record by date
                    $matchingMerit = $merits->where('merit_date', $item->date)->first();
                    if ($matchingMerit) {
                        $item->merit_points = $matchingMerit->merit_points;
                        $item->merit_current_points = $matchingMerit->merit_current_points;
                        $item->merit_date = $matchingMerit->merit_date;
                        $item->merit_time = $matchingMerit->merit_time;
                        $item->merits_descriptions = $matchingMerit->merits_descriptions;
                    }
                });

                $resultArray = $result->toArray();
                

                $pdf = new PDF();
                $pdf = PDF::LoadView('pdf.student_all_records', ['data' => $resultArray,
                                                                'demerit_sum' => $demerit_total_points, 
                                                                'merit_sum' => $merit_total_points,]);
                return $pdf->download('student_all_records.pdf');

                // return response(['demerit_sum' => $demerit_total_points, 
                //                  'merit_sum' => $merit_total_points,
                //                 'data' => $resultArray], 200);
            } catch (ModelNotFoundException $e) {
                return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
            } catch (\Exception $e) {
                return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
            }
        }

        return redirect()->route('auth.login');
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'student not found', 'msg' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }
}
