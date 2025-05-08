@props(['type' => 'danger', 'message' => ''])

<div class="alert alert-{{ $type }}">
    {{ $message }}
</div>
