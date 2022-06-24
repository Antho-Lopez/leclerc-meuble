@props(['route', 'method'=> 'POST', 'class' => null,'files' => false])


<form action="{{ $route }}" id="myForm" method="{{ $method }}" class="{{$class}}" enctype="multipart/form-data">
    @csrf
    {{ $slot }}
</form>
