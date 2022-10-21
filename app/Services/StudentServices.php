<?php

namespace App\Services;

use App\Http\Plugins\BaseHelper;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentServices
{

    /**
     * Function tạo 1 mã học viên mới và trả ra mã cho người dùng
     * @return integer code
     */
    public function createNewCodeStudent()
    {
        $currentYear = date("Y");
        $currentYear = $currentYear[2] . $currentYear[3];

        $query = DB::table('students')
            ->select(array( DB::raw('COUNT(code) as numberCode')))
            ->where('code', 'LIKE', $currentYear . '%')
            ->get();

        $codeStudent = $currentYear . date("m");
        $numberCode = $query[0]->numberCode + 1;
        for ($i = 0; $i < 4 - strlen($numberCode); $i++) {
            $codeStudent .= '0';
        }
        $codeStudent .= $numberCode;

        return $codeStudent;
    }

    /**
     * Function kiểm tra mã học viên có tồn tại hay không
     * @param integer $code
     */
    public static function checkIssetByCode($code) {
        try {
            if (Student::where('code', '=', $code)->exists()) {
                return true;
            }
            return false;

        } catch (\Exception $exception){
            return false;
        }
    }
}
