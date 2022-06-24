@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('product.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter un produit
        </a>
    </div>
    <x-card title="Liste des produits">

        <backoffice-products-search
            route_show="{{ route('product.show', "#") }}"
            route_edit="{{ route('product.edit', "#") }}"
            route_delete="{{ route('product.delete', "#") }}"
        >
        </backoffice-products-search>
        
    </x-card>
    </x-container>
@endsection
