<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
        /*
        morphMany() là phương thức dùng để khai báo quan hệ một-nhiều (one-to-many) trong quan hệ đa hình (polymorphic).
        comments() sẽ trả về tất cả các comment mà model Course có
        */
    }
}
