@props(['type' => 'success', 'message' => 'Thành Công'])

<div class="alert alert-{{ $type }}">
    {{ $message }}
</div>
