<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ## Lấy danh sách các khóa học có từ 5 bài học trở lên

        // Lấy dữ liệu từ bảng 'courses', đồng thời JOIN với bảng 'lessons'
        $courses = DB::table('courses')

            // Nối bảng 'courses' với bảng 'lessons' qua khóa ngoại 'course_id'
            ->join('lessons', 'courses.id', '=', 'lessons.course_id')

            // Chọn cột 'id' và 'title' của bảng 'courses'
            // Đồng thời đếm số lượng bài học (lessons) tương ứng với mỗi khóa học (course)
            ->select('courses.id', 'courses.title', DB::raw('COUNT(lessons.id) as lesson_count'))

            // Nhóm dữ liệu theo ID và tiêu đề khóa học (vì có sử dụng hàm COUNT nên cần groupBy)
            ->groupBy('courses.id', 'courses.title')

            // Chỉ lấy các khóa học có số lượng bài học từ 5 trở lên
            ->having('lesson_count', '>=', 5)

            // Thực thi truy vấn và lấy dữ liệu
            ->get();

        dd($courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function course2()
    {
        ## lấy course kèm theo số lượng lesson
        // $courses = DB::table('courses')
        //     // Kết nối bảng 'courses' với bảng 'lessons' theo khóa ngoại course_id
        //     ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')

        //     // Chọn cột ID và tiêu đề của khóa học, đồng thời đếm số lượng bài học liên quan
        //     ->select(
        //         'courses.id',
        //         'courses.title',
        //         DB::raw('COUNT(lessons.id) as lesson_count') // Dùng COUNT để đếm số bài học trong mỗi khóa học
        //     )

        //     // Gom nhóm theo ID và tiêu đề của khóa học để COUNT hoạt động đúng
        //     ->groupBy('courses.id', 'courses.title')

        //     // Thực hiện truy vấn và lấy kết quả
        //     ->get();

        ## tối ưu bằng Eager loading Eloquent
        $courses = Course::withCount('lessons')->get();

        // dd($courses);
        dd($courses->toArray());

        // echo '<pre>';
        // print_r($courses->toArray());
        // echo '</pre>';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function eagerCourse()
    {
        $courses = Course::with([
            'user',         // Giảng viên
            'lessons.tags'  // Mỗi bài học và tags của bài học
        ])->get();

        // dd($courses->toArray());

        // dd($courses[0]->user);
        // dd($courses[0]->lessons);

        echo '<pre>';
        print_r($courses->toArray());
        echo '</pre>';

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
