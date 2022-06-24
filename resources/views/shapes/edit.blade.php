
@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('shape.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'une forme">

        <div class="card-body">
            <x-form :route="route('shape.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>
                <x-form.input class="my-1" field="name" label="Nom de la forme *" :value="$shape->name"/>
                <x-form.file field="img_name" label="Modifier la photo" class="mt-2" />
                <div class="d-flex">
                    <div class="col-4">
                        <p>Image actuel : </p>
                    </div>
                    <div class="ms-3 mt-3">
                        <img class="w-75 img-fluid img-thumbnail" src="{{Storage::url($shape->img_name) }}" alt="{{ $shape->name }}">
                    </div>
                </div>
                <hr>
                <p class="h4 mb-3">Catégories :</p>
                <x-form.customcheckboxgroup label="categories" :value="$categories_shape->pluck('category_id')->all()" field="category_id" :values="$categories->pluck('name','id')->all()" />
                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
