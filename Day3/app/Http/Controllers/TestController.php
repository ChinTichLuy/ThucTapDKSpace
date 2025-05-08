<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ## Lấy toàn bộ bài viết đã được publish trong 30 ngày
        // $posts = Post::published()->recent()->get();
        // dd($posts);
        //trong items -> attributes xem bài viết

        ## Lấy danh sách tác giả có từ 5 bài viết trở lên
        // $authors=Author::has('posts', '>=', 5)->get();
        // dd($authors);

        ## Tạo mới bài viết cho tác giả cụ thể
        // $author = Author::find(9);

        // $author->posts()->create([
        //     'title' => 'Bài viết mới 2',
        //     'content' => 'Nội dung bài viết 2...',
        //     'status' => 'draft',
        //     'published_at' => now(),
        // ]);

        ## Cập nhật một bài viết theo slug
        // $post = Post::where('slug', 'bai-viet-moi')->first();

        // $post->update([
        //     'content' => 'Cập nhật nội dung 123...',
        //     'status' => 'archived',
        // ]);

        ## Xóa một tác giả và kiểm tra cascade xóa bài viết

        // $author = Author::find(10);
        // $preCount = Post::count();

        // $author->delete();

        // $postCountAfter = Post::count();
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
