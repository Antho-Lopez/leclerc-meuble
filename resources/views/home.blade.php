@extends('layouts.frontnav')
@section('content')
<div>
    <div style='background-image: url("{{'../..' . Storage::url($accueil->img_name)}}");  background-repeat: no-repeat; background-size: cover; background-position: center;'>
        <div class="background-home-style">
            <div class="container_custom col-12 d-flex justify-content-center">

                <div class="box_custom col-12 d-flex justify-content-center">
                    <div class="title_custom d-flex justify-content-center">
                        <span class="block_custom"></span>
                        <img class="bandeau-img" src="{{ asset('img/logo.png') }}">
                    </div>
                    <div class="role_custom d-flex justify-content-center">
                        <div class="block_custom"></div>
                        <p class="for-resp-fs">Meubles</p>
                    </div>
                </div>
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
    <div class="d-flex flex flex-column align-items-center mb-5">
        <div class="bg-white custom-m mb-4">
            <p class="h1 p-4 crazymond text-center">Découvrez nos services !</p>
        </div>

        <div class="">
            <div class="">
                <img class="w-100" src="{{Storage::url($services->img_name)}}">
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-start" style="width: 100%;">
            <div class="my-5 col-lg-7 col-md-7 col-sm-12 col-12  d-flex flex-column align-items-center justify-content-center">
                <p class="open-sans text-center h1 dark">{{ strtoupper($catalog->name) }}</p>
                <p class="">Cliquez sur le catalogue pour le consulter !</p>
            </div>
            <div class="py-5 col-lg-5 col-md-5 col-sm-12 col-12" style="background-color: #ddbaa6;">
                <div class="d-flex justify-content-center">
                    @if (strlen($catalog->link) > 5)
                        <a href="{{ route('catalog.forstat', $catalog->id) }}" class="d-flex align-items-center justify-content-center scalehover">
                            <img class="i-s" src="{{Storage::url($catalog->img_name)}}">
                        </a>
                    @else
                        <div class="clc" tabindex="0">
                            <div class="d-flex cursor-pointer scalehover shadow border">
                                <img class="i-s" src="{{Storage::url($catalog->img_name)}}">
                            </div>
                        </div>
                        <div class="cursor-pointer scale_home_visuel">
                            <div class="d-flex justify-content-center" style="margin-top: 15vh;">
                                <img class="img_on_click" src="{{Storage::url($catalog->img_name)}}">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="">
            <div class="">
                <img class="w-100" src="{{Storage::url($finance->img_name)}}">
            </div>
        </div>
    </div>
</div>

@endsection
