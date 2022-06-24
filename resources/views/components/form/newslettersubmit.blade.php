@props(['color', 'size' => 'col-6', 'value'])
<div>
    <button type="submit" class="btn btn-{{ $color }} {{ $size }}">{{ $value }} <i class="fas fa-arrow-circle-right ms-1"></i></i></button>
</div>