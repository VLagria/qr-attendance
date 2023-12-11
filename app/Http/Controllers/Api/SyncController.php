<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Demerit;
use App\Models\Merit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    public function attendanceSync(Request $request)
    {

        try {
            $student_list = $request->students; //naa diri tanan students
            foreach ($student_list as $student) {
                if ($student['attendance_type'] === 0) { //absent
                    Attendance::create([
                        'description' => $student['description'],
                        'is_present' => false,
                        'student_id' => $student['student_id'],
                        'date' => $student['attendance_date'],
                        'time' => $student['attendance_time'],
                        'is_absent' => true,
                        'is_late' => false
                    ]);
                }

                if ($student['attendance_type'] === 1) { //present
                    Attendance::create([
                        'description' => $student['description'],
                        'is_present' => true,
                        'student_id' => $student['student_id'],
                        'date' => $student['attendance_date'],
                        'time' => $student['attendance_time'],
                        'is_absent' => false,
                        'is_late' => false
                    ]);
                }

                if ($student['attendance_type'] === 2) { //late
                    Attendance::create([
                        'description' => $student['description'],
                        'is_present' => false,
                        'student_id' => $student['student_id'],
                        'date' => $student['attendance_date'],
                        'time' => $student['attendance_time'],
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

    public function gradeSystemSync(Request $request)
    {
        foreach ($request->students as  $student) {
            if ($student['grade_type'] === "Demerit") {  //Demerit
                $points = 0;
                $current_points = 0;
                $prev_points = 0;
                $retrieve_current_points = DB::table('demerits')
                    ->where('student_id', $student['student_id'])
                    ->orderBy('demerits.id', 'DESC')
                    ->first();
                if ($retrieve_current_points) {
                    $current_points = $student['points'] + $retrieve_current_points->current_points;
                    $points = $student['points'];
                    $prev_points = $retrieve_current_points->current_points;
                } else {
                    $current_points = $student['points'];
                    $points = $student['points'];
                    $prev_points = $student['points'];
                }

                $demerit = Demerit::create([
                    'student_id' => $student['student_id'],
                    'points' => $student['points'],
                    'description' => $student['grade_descriptions'],
                    'date' => $student['grade_date'],
                    'time' => $student['grade_time'],
                    'current_points' => $current_points,
                    'previous_points' => $prev_points
                ]);
            }
            if ($student['grade_type'] === "Merit") {  //Merit

                $points = 0;
                $current_points = 0;
                $prev_points = 0;
                $retrieve_current_points = DB::table('merits')
                    ->where('student_id', $request->student_id)
                    ->orderBy('merits.id', 'DESC')
                    ->first();
                if ($retrieve_current_points) {
                    $current_points = $student['points'] + $retrieve_current_points->current_points;
                    $points = $student['points'];
                    $prev_points = $retrieve_current_points->current_points;
                } else {
                    $current_points = $student['points'];
                    $points = $student['points'];
                    $prev_points = $student['points'];
                }

                $merit = Merit::create([
                    'student_id' => $student['student_id'],
                    'points' => $student['points'],
                    'description' => $student['grade_descriptions'],
                    'date' => $student['grade_date'],
                    'time' => $student['grade_time'],
                    'current_points' => $current_points,
                    'previous_points' => $prev_points
                ]);
            }
        }
        return response(['msg' => "Sync Successfully"], 200);
    }
}
