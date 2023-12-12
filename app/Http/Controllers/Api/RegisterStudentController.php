<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class RegisterStudentController extends Controller
{
    public function showStudenRegistration(){
        return view('student.student-register');
    }

    public function registerStudent(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|unique',
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
            return view('student.done');
        } catch (ValidationException $e) {
            return response(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response(['error' => 'Something went wrong. Please try again.', 'msg' => $e->getMessage()], 500);
        }
    }
}
