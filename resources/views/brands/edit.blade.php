
@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('brand.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
      </div>
    <x-card title="Modification de la marque : {{ $brand->name }}">

        <div class="card-body">
            <x-form files="true" :route="route('brand.update', request()->route('id'))">
                <x-form.input class="my-1" field="name" label="Nom *" :value="$brand->name" />
                <hr>
                <p class="h4 mb-3">Catégories :</p>
                <x-form.customcheckboxgroup label="categories" :value="$brand_categories->pluck('category_id')->all()" field="category_id" :values="$categories->pluck('name','id')->all()" />
                <x-form.submit color="primary" size="col-4 m-2 mt-4" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
