{{-- <x-mail::message>
# Bình luận mới

Người dùng đã bình luận trên bài viết **{{ $comment->post->title }}**.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}

@component('mail::message')
# Bình luận mới cho bài viết

**Bài viết**: {{ $comment->post->title }}

**Người bình luận**: {{ $comment->user->name }}

**Nội dung**:
{{ $comment->content }}

Cảm ơn bạn đã sử dụng hệ thống!
@endcomponent
