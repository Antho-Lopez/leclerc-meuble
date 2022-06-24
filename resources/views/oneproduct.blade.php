@extends('layouts.frontnav')
@section('content')
<div>
    <div style="padding-top: 17vh;">

    </div>
    <?php
    if (Auth::user()) {
        $auth_id = Auth::user()->id;
    } else {
        $auth_id = "not registered";
    }
    ?>
    <div>
        <one-product
            suggestion="{{ route('oneproduct', "#") }}"
            id="{{$product->id}}"
            route_add_fav="{{ url("product/#/add_fav/$auth_id") }}"
            route_remove_fav="{{ url("product/#/remove_fav/$auth_id") }}"
            auth_id="{{ $auth_id }}"
            no_visuel="{{asset('img/no-visuel.jpg')}}"
        >
        </one-product>
    </div>
</div>
@endsection
