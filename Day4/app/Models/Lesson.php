<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;
    protected $fillable = [
        'course_id',
        'title',
        'content',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
