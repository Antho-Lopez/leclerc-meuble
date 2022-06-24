
@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('color.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'une catégorie">

        <div class="card-body">
            <x-form :route="route('color.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>
                <x-form.input class="my-1" field="name" label="Nom de la couleur *" :value="$color->name"/>
                <div class="d-flex justify-content-center">
                    <div class="test col-12">
                        <input type="color" id="color" name="color_code" value="{{$color->color_code}}">
                        <div class="info">
                            <h5>Color picker</h5>
                            <h6>Cliquez sur la couleur pour choisir</h6>
                        </div>
                    </div>
                </div>
                <hr>
                <p class="h4 mb-3">Catégories :</p>
                <x-form.customcheckboxgroup label="categories" :value="$categories_color->pluck('category_id')->all()" field="category_id" :values="$categories->pluck('name','id')->all()" />
                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
