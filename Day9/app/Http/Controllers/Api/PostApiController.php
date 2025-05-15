<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostApiController extends Controller
{
    // Lấy danh sách bài viết
    public function index(Request $request)
    {
        $query = Post::query();

        // Lọc theo trạng thái nếu có
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->latest()->paginate(10);
        return response()->json($posts);
    }

    // Lấy chi tiết 1 bài viết
    public function show(Post $post)
    {
        return response()->json($post);
    }

    // Tạo mới bài viết
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $post = Auth::user()->posts()->create($validated);

        return response()->json($post, 201);
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        // Optional: chỉ cho tác giả hoặc admin sửa
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'status' => 'sometimes|in:draft,published',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    // Xoá bài viết
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
