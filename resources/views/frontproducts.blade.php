@extends('layouts.frontnav')
@section('content')
<div>
    <div style='height: 80vh; margin-top: -10vh; background-image: url("{{'/..' . Storage::url($current_category->img_name)}}");  background-repeat: no-repeat; background-size: cover; background-position: center;'>
        <div class="" style="padding-top: 25vh;">
            <div class="container_products col-12 d-flex justify-content-center">
                <h1 class="h1 text-center">{{$current_category->name}}</h1>
            </div>
        </div>

    </div>
    <?php
    if (Auth::user()) {
        $auth_id = Auth::user()->id;
    } else {
        $auth_id = "not registered";
    }
    ?>
    <product-search
        one_product="{{ route('oneproduct', "#") }}"
        id_category="{{$current_category->id}}"
        route_add_fav="{{ url("product/#/add_fav/$auth_id") }}"
        route_not_connected="{{ url("login") }}"
        route_remove_fav="{{ url("product/#/remove_fav/$auth_id") }}"
        auth_id="{{ $auth_id }}"
        no_visuel="{{asset('img/no-visuel.jpg')}}"
    >
    </product-search>
</div>
@endsection
