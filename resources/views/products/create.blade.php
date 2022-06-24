
@extends('layouts.nav')

@section('content')
<x-container>
    <?php
    $test = $categories->pluck('name', 'id');
    $place = "oui";
    ?>
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('product.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Ajout d'un produit">

        <div class="card-body">
            <x-form files="true" :route="route('product.store')">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>

                <x-form.input class="my-1" field="name" label="Nom *" />
                {{-- <x-form.select class="my-1" field="category_id" label="Catégorie" :values="$categories->pluck('name', 'id')" /> --}}
                <select-category categories="{{$categories}}"></select-category>
                <x-form.select class="my-1" field="inspiration_id" label="Collection" :values="$inspirations->pluck('name', 'id')" style="margin-top: 20px" />
                <x-form.text class="my-1" rows="5" field="description" label="Description" />
                <x-form.text class="my-1" rows="5" field="details" label="Détails" />
                <x-form.input class="my-1" field="price" label="Prix" />
                <x-form.select class="my-1" field="brand_id" label="Marque" :values="$brands->pluck('name', 'id')" />
                <x-form.input class="my-1" field="production" label="Production" />
                <hr>
                <p class="h4 mb-3">Dimensions :</p>
                <x-form.customcheckboxgroup label="Dimensions" field="dimension_id" :values="$dimensions->pluck('size','id')->all()" />
                <hr>
                <p class="h4 mb-3">Couleurs :</p>
                <x-form.customcheckboxgroup label="Couleurs" field="color_id" :values="$colors->pluck('name','id')->all()" />
                <hr>
                <p class="h4 mb-3">Matériaux / Revetements :</p>
                <x-form.customcheckboxgroup label="Matériaux / Revetements" field="material_id" :values="$materials->pluck('name','id')->all()" />
                <hr>
                <p class="h4 mb-3">Formes :</p>
                <x-form.customcheckboxgroup label="Formes" field="shape_id" :values="$shapes->pluck('name','id')->all()" />
                <hr>
                <x-form.files field="img_product[]" label="Ajouter des photos à ce produit ?" class="m-2" />

                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
