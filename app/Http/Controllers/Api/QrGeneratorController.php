<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Models\Student;
use PHPUnit\Framework\MockObject\Builder\Stub;

class QrGeneratorController extends Controller
{
    public function generateQrCode($id)
    {
        try {

            $data = Student::where('id', $id)->select('id', 'student_id', 'first_name', 'last_name', 'middle_name', 'year_lvl')->first();

            $qrcode = QrCode::size(300)->generate(json_encode($data));
            return $qrcode;
        } catch (ModelNotFoundException $e) {
            return response(['msg' => 'Order not found', 'error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response(['error' => 'An error occurred', 'msg' => $e->getMessage()], 500);
        }
    }
}
