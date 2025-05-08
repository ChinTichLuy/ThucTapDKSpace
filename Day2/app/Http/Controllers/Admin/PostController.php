<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5); // để slug không bị trùng

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Tạo bài viết thành công!');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
}
