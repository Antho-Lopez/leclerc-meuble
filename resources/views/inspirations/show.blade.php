@extends('layouts.nav')
<?php 
$space = str_replace('-', ' ', $inspiration->name)
?>
@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('inspiration.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>

    <x-card title="Collection : {{ ucwords($space) }}">
        <div class="card-body">
            <p class="h2 text-center fw-bold pt-2 pb-2">{{ ucwords($space) }}</p>
            <p class="casse h4 text-center pt-2 pb-2">"{{ $inspiration->description }}"</p>
            <div class="col-12 d-flex justify-content-center align-item-center mt-3 mb-3">
                <a href="{{ route('inspiration.edit', $inspiration->id) }}" class="ms-2 btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier les infos</a> 
            </div>
            <div class="d-flex justify-content-center">
                <div class="m-4 col-10 d-flex flex-column align-items-center justify-content-center">
                    <p class="h4 fw-bold pt-0">Image d'illustration :</p>
                    <img class="w-50 img-fluid img-thumbnail" src="{{Storage::url($inspiration->img_name) }}" alt="{{ $inspiration->name }}">
                </div>
            </div>
            <hr>
            <p class="h3 pt-2 pb-2">Produits disponibles dans cette collection</p>
            <div class="d-flex flex-wrap justify-content-center">
            @foreach ($inspiration->products as $product)
                <x-card size="col-3 m-2" class="">
                    @foreach ($product->img_products->where('is_first', 1) as $img_first)
                        <img src="{{ Storage::url('product/' . $product->id . '/'  . $img_first->id . '-' . $img_first->img_name) }}" class="card-img-top align-self-center" alt="{{ $img_first ->img_name }}">
                    @endforeach
                    <div class="card-body">
                        <hr>
                        <h5 class="card-title fs-3 mt-2 mb-2">{{ $product->name }}</h5>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Voir ce produit</a>
                    </div>
                </x-card>
            @endforeach
            </div>
         
        </div>
    </x-card>
</x-container>
@endsection
