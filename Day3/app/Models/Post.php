<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

/*
Model: Lớp cha của mọi Eloquent model

HasFactory: Trait giúp dùng factory() khi tạo dữ liệu

Str: Hỗ trợ xử lý chuỗi, dùng để tạo slug

Carbon: Thư viện xử lý ngày giờ
*/

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ['author_id', 'title', 'slug', 'content', 'status', 'published_at'];

    public function author()
    {
        // Xác định quan hệ bài viết thuộc về một tác giả
        return $this->belongsTo(Author::class);
    }

    // Local Scopes (Phạm vi cục bộ)
    public function scopePublished($query) //scopePublished() hàm mở rộng truy vấn
    {
        // Dùng như: Post::published()->get(), chỉ lấy bài có status là published
        return $query->where('status', 'published');
    }

    public function scopeRecent($query) // scopeRecent() lấy bài viết tạo trong 30 ngày gần nhất
    {
        return $query->where('created_at', '>=', now()->subDays(30)); // now()->subDays(30) = ngày hiện tại trừ 30 ngày(30 ngày gần nhất trờ về trước)
    }

    ## Mutators & Accessors
    // Đây là Mutator – nó chạy khi gán giá trị title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value); // ucwords($value) viết hoa chữ cái đầu các từ
        $this->attributes['slug'] = Str::slug($value); // Str::slug($value) tạo slug dạng URL (vd: "Hello World" → "hello-world")
        /*
        vd: khi truyền $post->title = "hello world", nó sẽ tự lưu:
        title = "Hello World"
        slug = "hello-world"
        */
    }

    //Đây là Accessor – nó chạy khi đọc $post->published_at
    public function getPublishedAtAttribute($value)
    {
        //Nếu published_at không null → định dạng lại thành ngày/tháng/năm giờ:phút
        return $value ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }
}
