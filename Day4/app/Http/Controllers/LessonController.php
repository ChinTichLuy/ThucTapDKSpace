<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ## Lấy các bài học có tag 'Laravel'

        $lessons = DB::table('lessons') // Bắt đầu truy vấn từ bảng 'lessons'

            // Nối bảng trung gian 'lesson_tag' để lấy thông tin gắn thẻ lesson
            ->join('lesson_tag', 'lessons.id', '=', 'lesson_tag.lesson_id')

            // Nối tiếp bảng 'tags' để lọc theo tên tag
            ->join('tags', 'tags.id', '=', 'lesson_tag.tag_id')

            // Lọc chỉ lấy các lesson có gắn tag tên là 'Laravel'
            ->where('tags.name', 'Laravel')

            // Lấy toàn bộ thông tin của lesson đó
            ->select('lessons.*')

            // Thực hiện truy vấn và lấy kết quả
            ->get();

        dd($lessons);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function countCmt()
    {
        ## Đếm tổng số comment của mỗi lesson

        $commentsPerLesson = DB::table('lessons')
            // Dùng leftJoin để đảm bảo rằng các bài học không có bình luận cũng sẽ được đưa vào kết quả
            ->leftJoin('comments', function ($join) {
                $join->on('lessons.id', '=', 'comments.commentable_id') // Ghép bài học với comment dựa vào commentable_id
                    ->where('comments.commentable_type', '=', 'Lesson'); // Lọc ra chỉ những comment thuộc loại Lesson
            })
            ->select(
                'lessons.id',   // Lấy ID của bài học
                'lessons.title',        // Lấy tiêu đề bài học
                DB::raw('COUNT(comments.id) as comment_count') // Đếm số lượng bình luận ứng với bài học đó
            )
            ->groupBy('lessons.id', 'lessons.title') // Gom nhóm theo ID và tiêu đề bài học để tính tổng số comment cho mỗi bài học
            ->get(); // Thực hiện truy vấn và lấy kết quả

        dd($commentsPerLesson);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function eagerCmt($lessonId)
    {
        ## Lấy 1 bài học cụ thể cùng với:Các comment, Người viết comment
        ## Eager loading, Eloquent
        $lesson = Lesson::with([
            'comments.user'  // Comment và người viết comment
        ])->findOrFail($lessonId);

        dd($lesson->toArray());

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
