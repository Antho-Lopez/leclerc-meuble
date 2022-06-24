@props(['title', 'size' => 'col-12', 'class' => ''])

<div class="{{ $size }} {{ $class }}">

    <div class="card">

        @isset($title)

        <div class="card-header text-center">{{ $title }}</div>

        @endisset

        {{$slot}}

    </div>

</div>

