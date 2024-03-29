<?php

namespace App\Http\Controllers;

use App\Http\Plugins\BaseHelper;
use App\Models\ClassHc;
use App\Models\Intern;
use App\Services\ClassStudentService;
use App\Services\InternService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassHcController extends Controller
{
    private $internService;

    private $classStudentService;

    public function __construct(InternService $internService,
                                ClassStudentService $classStudentService)
    {
        $this->internService = $internService;
        $this->classStudentService= $classStudentService;
    }

    public function list(Request $request)
    {
        $filters = $request->all();

        $courses = DB::table('courses')->select('id', 'name')->get();

        $coursesName = [];

        foreach ($courses as $course) {
            $coursesName[$course->id] = $course->name;
        }

        $query = DB::table('classes_hc', 'c')
            ->join('interns as coach', 'c.coach', '=', 'coach.student_code')
            ->join('interns as cs', 'c.carer_staff', '=', 'cs.student_code');
        $query->orderBy('c.starttime', 'DESC');

        if ($request->isMethod('POST')){
            $paged = $filters['page'];

            unset($filters['page']);
            unset($filters['_token']);

            foreach ($filters as $key => $value){
                if ($value != '' && $value != NULL){
                    switch ($key){
                        case 'name':
                            $query->where('c.name', 'LIKE', '%' . $value . '%');
                            break;
                        case 'course_id':
                            $query->where('c.course_id', '=', $value);
                            break;
                        case 'yearOfStart':
                            $query->where('c.starttime', 'LIKE',  $value . '%' );
                            break;
                        case 'status':
                            $query->where('c.status', '=', $value);
                            break;
                        default:
                            break;
                    }
                }
            }
            $classes = $query->paginate(20, ['c.*', 'coach.name as coach_name', 'cs.name as cs_name'], 'page', $paged);
        } else {
            $classes = $query->paginate(20, ['c.*', 'coach.name as coach_name', 'cs.name as cs_name']);
        }

        $listIntern = $this->internService->getListCurrent();

        return view('classes.list',compact('classes', 'coursesName', 'filters', 'listIntern'));
    }

    /**
     * Lấy ra thông tin của 1 lớp học và trả ra qua Ajax
     * @param Request $request
     * @param $id
     */
    public function getInfoAjax(Request $request, $id)
    {
        $this->checkRequestAjax($request);

        $class = ClassHc::findOrFail($id);
        $class->starttime = $this->changeFormatDateOutput($class->starttime);
        $class->finishtime = $this->changeFormatDateOutput($class->finishtime);
        BaseHelper::ajaxResponse('success', true, $class);
    }

    /**
     * Lưu thông tin của 1 lớp học khi chỉnh sửa hoặc thêm mới
     * @param Request $request
     */
    public function saveInfoAjax(Request $request)
    {
        $this->checkRequestAjax($request);

        $requestData = $request->all();
        //Check code Intern Coach
        if (!Intern::where('student_code', '=', $requestData['coach'])->exists()) {
            BaseHelper::ajaxResponse('Mã Trợ giảng lớp không đúng!', false);
        }

        //Check code Intern Carer_staff
        if (!Intern::where('student_code', '=', $requestData['carer_staff'])->exists()) {
            BaseHelper::ajaxResponse('Mã Chủ nhiệm lớp không đúng!', false);
        }

        if ($requestData['carer_staff'] == $requestData['coach']) {
            BaseHelper::ajaxResponse('Mã Trợ giảng và Chủ Nhiệm lớp bị trùng nhau!', false);
        }

        if (!isset($requestData['id']) || empty($requestData['id'])){
            # Create new class
            $class = new ClassHc();
            $class->created_by = Auth::id();
            $class->created_at = Carbon::now();
        } else {
            #update infomation class
            $class = ClassHc::findOrFail($requestData['id']);
            $class->updated_by = Auth::id();
            $class->updated_at = Carbon::now();

            $classOldStatus = $class->status;
        }

        $class->name        = $requestData['name'];
        $class->course_id   = $requestData['course_id'];
        $class->carer_staff = $requestData['carer_staff'];
        $class->coach       = $requestData['coach'];
        $class->status      = $requestData['status'];
        $class->reg_status  = $requestData['reg_status'];
        $class->note        = $requestData['note'];
        $class->starttime   = $this->changeFormatDateInput($requestData['starttime']);
        $class->finishtime  = $this->changeFormatDateInput($requestData['finishtime']);

        try {
            $class->save();

            if(isset($requestData['id']) && !empty($requestData['id'])) {
                if($classOldStatus == 1 && $classOldStatus != $requestData['status']) {
                    $result = $this->classStudentService->updateStatusCs($requestData['id'], $requestData['status']);
                    if($result) {
                        BaseHelper::ajaxResponse(config('app.textSaveSuccess'), true);
                    } else {
                        BaseHelper::ajaxResponse(config('Xử lý dữ liệu học viên bị lỗi!'), true);
                    }
                }
            }

            BaseHelper::ajaxResponse(config('app.textSaveSuccess'), true);
        }catch (\Exception $exception){
//            print_r($exception->getMessage());
//            die();
            BaseHelper::ajaxResponse(config('app.textSaveError'), false);
        }
    }

    /**
     * Function trả ra trang view xem nhật ký 1 lớp học
     * @param $id
     */
    public function diary($classId)
    {

        $class = DB::table('classes_hc', 'chc')
            ->join('courses as c', 'chc.course_id', '=', 'c.id')
            ->join('interns as coach', 'chc.coach', '=', 'coach.student_code')
            ->join('interns as cs', 'chc.carer_staff', '=', 'cs.student_code')
            ->select('chc.id', 'chc.course_id', 'chc.name',  'chc.status',
                'chc.starttime', 'chc.finishtime',  'c.name as course_name', 'c.length',
                'chc.coach', 'coach.name as coach_name', 'coach.img as coach_img',
                'chc.carer_staff', 'cs.name as carer_staff_name', 'cs.img as carer_staff_img')
            ->where('chc.id', '=', $classId)
            ->get();
        if(!count($class)) {
            return view('pages.errors.404');
        }

        $class = $class[0];
        $listStudent = DB::table('students', 's')
            ->join('classes_students as cs', 's.code', '=', 'cs.student_code')
            ->where('cs.class_id', '=', $classId)
            ->select('s.id', 's.code', 's.name', 's.birthday', 's.img', 's.phone', 's.email', 's.facebook', 's.native_place',
                'cs.id as csid', 'cs.starttime', 'cs.finishtime', 'cs.fees', 'cs.date_payment',
                'cs.course_where', 'cs.desire', 'cs.status', 'cs.note')
            ->get();

        $listStudy = DB::table('studies', 's')
            ->join('interns as c', 's.coach', '=', 'c.student_code')
            ->join('interns as cs', 's.carer_staff', '=', 'cs.student_code')
            ->select('s.id', 's.lesson_id', 's.lesson_name', 's.teacher', 's.coach', 's.carer_staff',
                's.daylearn', 's.location', 's.status', 's.number_eat', 's.number_learn', 's.description',
                'c.name as coach_name', 'cs.name as carer_staff_name')
            ->where('s.class_id', '=', $classId)
            ->get();

        $listAtten = DB::table('attendances', 'a')
            ->join('studies as study', 'a.study_id', '=', 'study.id')
            ->join('students as s', 'a.student_code', '=', 's.code')
            ->select('a.id', 'a.study_id', 'a.student_code',  'a.status', 'a.note',
                'a.feedback', 'a.question', 'a.comment', 's.name', 's.img')
            ->where([
                ['study.class_id', '=', $class->id],
                ['a.student_type', '=', 0],
            ])
            ->get();

        $teachers = DB::table('teachers')->where('status', '=', 1)->get(['id', 'name', 'subname']);
        $listTeacher = [];
        foreach ($teachers as $teacher) {
            if(empty($teacher->subname)) {
                $listTeacher[$teacher->id] = $teacher->name;
            } else {
                $listTeacher[$teacher->id] = $teacher->subname . ' ' . $teacher->name;
            }
        }

        $lessons = DB::table('lessons')
            ->where('course_id', '=', $class->course_id)
            ->orderBy('order')
            ->get(['id', 'name', 'teacher_id', 'status']);
        $listLesson = [];
        foreach ($lessons as $lesson) {
            $listLesson[$lesson->id] = [
                'id'   => $lesson->id,
                'name' => $lesson->name,
                'status' => $lesson->status,
                'teacher_id' => $lesson->teacher_id,
            ];
        }

        $listStuAtten = [];
        $studentLearn = 0;
        foreach ($listStudent as $student) {
            $listStuAtten[$student->code] = [
                'name' => $student->name,
                'img'  => $student->img,
                'status'  => $student->status,
                'inClass' => true,
                'atten' => [],
            ];

            if(in_array($student->status, [1,2,4])) $studentLearn++;
        }

        foreach ($listAtten as $atten) {
            if(!isset($listStuAtten[$atten->student_code])) {
                $listStuAtten[$atten->student_code] = [
                    'name' => $atten->name,
                    'img'  => $atten->img,
                    'inClass' => false,
                    'atten' => [],
                ];
            }

            $listStuAtten[$atten->student_code]['atten'][$atten->study_id] = [
                'id'       => $atten->id,
                'status'   => $atten->status,
                'note'     => $atten->note,
                'feedback' => $atten->feedback,
                'question' => $atten->question,
                'comment'  => $atten->comment,
            ];
        }

//        print_r($listStudent);
//        print_r($listStuAtten);
//        die();

        $listIntern = $this->internService->getListCurrent();

        return view('classes.diary',
            compact('class','listStudent', 'listStudy', 'listTeacher', 'listLesson',
                'listStuAtten', 'listIntern', 'studentLearn'));
    }

}
