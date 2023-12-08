<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function schoolActivityReceipt(){
        return view('receipt.school-activity-receipt');
    }

    public function monthlyFormationReceipt($id){
        $attendance = DB::table('attendances')
                        ->join('students', 'attendances.student_id', 'students.id')
                        ->select('attendances.*','students.year_lvl as year_level', 'students.first_name', 'students.last_name', 'students.middle_name')
                        ->where('attendances.id', $id)
                        ->first();
        return view('receipt.monthly-formation-receipt', ['attendance' => $attendance]);
    }

    public function meritReceipt($id){
        $merit = DB::table('merits')
                        ->join('students', 'merits.student_id', 'students.id')
                        ->select('merits.*','students.student_id as display_id','students.year_lvl as year_level', 'students.first_name', 'students.last_name', 'students.middle_name')
                        ->where('merits.id', $id)
                        ->first();
        return view('receipt.meiret-receipt',['merit' => $merit]);
    }

    public function demeritReceipt($id){
        $demerit = DB::table('demerits')
                        ->join('students', 'demerits.student_id', 'students.id')
                        ->select('demerits.*','students.student_id as display_id','students.year_lvl as year_level', 'students.first_name', 'students.last_name', 'students.middle_name')
                        ->where('demerits.id', $id)
                        ->first();
        return view('receipt.demerit-receipt',['demerit' => $demerit]);
    }
}
