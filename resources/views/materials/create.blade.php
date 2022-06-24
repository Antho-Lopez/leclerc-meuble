
@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('material.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Ajout d'un nouveau matériau">

        <div class="card-body">
            <x-form :route="route('material.store')">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>
                <x-form.input class="my-1" field="name" label="Nom du matériau / revetement *" />
                <hr>
                <p class="h4 mb-3">Catégories :</p>
                <x-form.customcheckboxgroup label="Catégories" field="category_id" :values="$categories->pluck('name','id')->all()" />
                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
