<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dùng Cache::remember để lưu cache
        // Cache sẽ được lưu với key 'top_posts_today' trong 30 phút (addMinutes(30))
        $topPosts = Cache::remember('top_posts_today', now()->addMinutes(30), function () {
            // whereDate('created_at', ...) dùng để so sánh chỉ phần ngày (không xét giờ, phút, giây) trong cột created_at
            // Tìm các bản ghi trong bảng posts mà cột created_at có cùng ngày với ngày hôm nay.
            return Post::whereDate('created_at', now()->toDateString()) //toDateString()	Lấy chuỗi ngày định dạng YYYY-MM-DD (bỏ phần giờ)
                ->orderByDesc('views')
                ->take(5)
                ->get();
        });
        $allPosts = Post::orderByDesc('created_at')->paginate(5);

        return view('posts.postList', compact('topPosts', 'allPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.postCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // dd(Auth::id());
        // Lưu bài viết mới
        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'views' => 0,
        ]);

        // Cache::forget() dùng để xóa cache cũ, giúp hệ thống làm mới lại dữ liệu được cache vào lần kế tiếp
        Cache::forget('top_posts_today');

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được đăng!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        // Tăng giá trị cột views của bản ghi $post lên 1 đơn vị và lưu thay đổi vào cơ sở dữ liệu ngay lập tức.
        $post->increment('views');

        //lấy comment
        $post = Post::with('comments.user')->findOrFail($id);

        // Nếu bài viết được tạo hôm nay => xoá cache top bài viết hôm nay
        if ($post->created_at->isToday()) {
            Cache::forget('top_posts_today');
        }

        return view('posts.postDetail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.postUpdate', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        Cache::forget('top_posts_today');

        return redirect()->route('posts.show', $post->id)->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Cache::forget('top_posts_today');

        return redirect()->route('posts.index')->with('success', 'Xoá bài viết thành công!');
    }
}
