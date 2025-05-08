<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $users = User::factory(10)->create();
        // foreach ($users as $user) {
        //     // Tạo và gắn Profile cho từng User
        //     $profile = Profile::factory()->make();
        //     $user->profile()->save($profile);

        //     // Tạo 3 khóa học cho mỗi user
        //     $courses = Course::factory(3)->make();

        //     foreach ($courses as $course) {
        //         // Gắn user_id thủ công rồi lưu vào DB
        //         $course->user_id = $user->id;
        //         $course->save();

        //         // Tạo 5 bài học cho mỗi khóa học
        //         $lessons = Lesson::factory(5)->make();
        //         foreach ($lessons as $lesson) {
        //             $lesson->course_id = $course->id;
        //             $lesson->save();
        //         }

        //         // Tạo 3 tag cho mỗi khóa học (hoặc có thể tạo sẵn tag rồi gắn vào bài học)
        //         $tags = Tag::factory(3)->create();

        //         // Gắn 3 tag vào 1 bài học đầu tiên trong khóa học
        //         $firstLesson = $course->lessons()->first();
        //         if ($firstLesson) {
        //             $firstLesson->tags()->attach($tags->pluck('id'));
        //         }
        //     }
        // }

        ## Dọn sạch dữ liệu bảng 'comments' trước khi seed
        // Comment::query()->delete(); // hoặc dùng ->truncate()
        /*
        truncate()	Xóa toàn bộ dữ liệu và reset lại auto-increment ID, dùng khi không có khóa ngoại(foreign key)(MySQL sẽ báo lỗi)
        delete()	Chỉ xóa dữ liệu, không reset auto-increment ID
        */

        Comment::factory(100)->create();
    }
}
