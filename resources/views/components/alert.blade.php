@props(['type' => "danger"])
<div class="alert alert-{{ $type }}" role="alert">
    {{ $slot }}
</div>