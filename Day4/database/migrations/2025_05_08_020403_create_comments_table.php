<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->morphs('commentable'); // commentable_id & commentable_type, morphs (quan hệ đa hình - polymorphic relationship)
            /*
            Dùng để tạo quan hệ đa hình (polymorphic)
            → tức là comment này có thể gắn với nhiều loại model khác nhau,
            mỗi cmt là cho 1 model KHÔNG liên quan về quan hệ cha con giữa các model.
            ( ở đây là Course, Lesson).
            kiểu như:
            "Course này bổ ích": commentable_id = 1 & commentable_type = App\Models\Course
            "Lesson này hay": commentable_id = 5 & commentable_type = App\Models\Lesson
            */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
