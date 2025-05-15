<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search'); // Lấy từ khóa tìm kiếm

        if (Auth::user()->role === 'admin') {
            $posts = Post::when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
                ->latest()
                ->paginate(5);
        } else {
            $posts = Post::where(function ($query) {
                $query->where('status', 'published')
                    ->orWhere(function ($q) {
                        $q->where('status', 'draft')
                            ->where('user_id', Auth::id());
                    });
            })
                ->when($search, function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(5);
        }

        // Gắn search vào pagination links
        $posts->appends(['search' => $search]);

        if (Auth::user()->role === 'admin') {
            return view('admin.posts.postList', compact('posts', 'search'));
        }

        return view('user.posts.postList', compact('posts', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            return view('admin.posts.postCreate');
        }
        return view('user.posts.postCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Lấy dữ liệu
        $data = $request->only('title', 'content');

        // Tạo slug ngẫu nhiên theo title + chuỗi random
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);

        $request->user()->posts()->create($data);

        return redirect()->route('posts.index')->with('success', 'Tạo mới bài viết thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Auth::user()->role === 'admin') {
            return view('admin.posts.postDetail', compact('post'));
        }
        return view('user.posts.postDetail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        if (Auth::user()->role === 'admin') {
            return view('admin.posts.postUpdate', compact('post'));
        }
        return view('user.posts.postUpdate', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd('Vào được controller');

        $this->authorize('update', $post);
        // dd('Qua được policy');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published',
        ]);
        // dd('Qua được validate');

        $post->update($request->only('title', 'content', 'status'));
        // dd('Qua được update');

        return redirect()->route('posts.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Xóa thành công!');
    }
}
