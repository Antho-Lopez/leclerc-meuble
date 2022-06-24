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
                        <p>Meubles</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex flex-column align-items-center mb-5">
        <div class="bg-white custom-m mb-4">
            <p class="h1 p-4 crazymond text-center">Découvrez nos dernières collections !</p>
        </div>
        <div class="d-flex flex-wrap justify-content-center custom-padding" style="background-color: #cbaf99c7; width: 100%;">
            @foreach ($fav_collections as $fav_collection)
                <?php
                    $space = str_replace('-', ' ', $fav_collection->name);
                    $name = ucwords($space);
                    $time_name = substr($fav_collection->img_name, strpos($fav_collection->img_name, "/") + 1);
                ?>
                <div class="col-lg-3 col-md-4 col-sm-8 col-10 d-flex flex-column align-items-center justify-content-center m-3">
                    <a href="{{ route('collectionproducts', $fav_collection->id) }}" class="bon hover-black"><img class="img-thumbnail mt-3 img-size" src="{{ Storage::url($fav_collection->name . '/miniature-' . $time_name) }}" alt="{{ $fav_collection->name }}"></a>
                    <p class="position-absolute los-andes text-white ziofz h4">Voir plus</p>
                    <p class="h2 pt-3 los-andes">{{ $name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
