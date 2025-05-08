<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    public function commentable()
    {
        return $this->morphTo();
        /*
        morphTo() giúp lấy đối tượng gốc mà comment thuộc về (ví dụ: lấy Course hoặc Lesson).

        Nó sử dụng 2 cột commentable_id và commentable_type để xác định model mà comment đang gắn vào.

        không cần phải xác định cụ thể belongsTo() cho mỗi model nữa.
        */
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
