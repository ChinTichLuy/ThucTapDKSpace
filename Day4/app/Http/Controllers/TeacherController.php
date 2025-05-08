<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ## Lấy top 3 giảng viên có nhiều khóa học nhất
        $topTeachers = DB::table('users')  // Bắt đầu truy vấn từ bảng 'users' (người dùng)
            ->join('courses', 'users.id', '=', 'courses.user_id')  // Nối bảng 'courses' để lấy thông tin khóa học của người dùng
            ->select('users.id', 'users.name', DB::raw('COUNT(courses.id) as course_count'))  // Chọn ID và tên người dùng, cùng với số lượng khóa học của họ
            ->groupBy('users.id', 'users.name')  // Nhóm kết quả theo ID và tên người dùng
            ->orderByDesc('course_count')  // Sắp xếp số lượng khóa học từ nhiều nhất đến ít nhất
            ->limit(3)  // Lấy 3 ng dùng đầu tiên (vì lúc này đã sắp xếp qua orderByDesc ở trên)
            ->get();  // Thực hiện truy vấn và lấy kết quả

        dd($topTeachers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
