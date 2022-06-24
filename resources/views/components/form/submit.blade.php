@props(['color', 'size' => 'col-6', 'value'])
<div class="d-flex justify-content-center col-12">
    <button type="submit" onclick="disableBtn()" id="myBtn" class="btn btn-{{ $color }} {{ $size }}">{{ $value }} <i class="fas fa-arrow-circle-right ms-1"></i></i></button>
</div>
