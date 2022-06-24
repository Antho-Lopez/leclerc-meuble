
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
    <x-card title="Modification de la collection {{ $inspiration->name }}">
        
        <div class="card-body">
            <x-form files="true" :route="route('inspiration.update', request()->route('id'))">
                <x-form.input class="my-1" field="name" label="Nom *" :value="ucwords($space)" />
                <x-form.text rows="5" class="my-1" field="description" label="Description" :value="$inspiration->description" />
                <x-form.file field="img_name" label="Modifier la photo" class="mt-2" />

                <div class="d-flex">
                    <div class="col-4">
                        <p>Image actuel : </p>
                    </div>
                    <div class="ms-3 mt-3">
                        <img class="w-25 img-fluid img-thumbnail" src="{{Storage::url($inspiration->img_name) }}" alt="{{ $inspiration->name }}">
                    </div>
                </div>  

                <div class="form-check d-flex">
                    <div class="col-4">
                    </div>
                    <div class="ms-3 mt-3">
                        <input class="form-check-input" name="is_favorite" @if($inspiration->is_favorite == 1) checked @endif type="checkbox" value="1">
                        <label class="form-check-label">
                            Mettre la collection sur l'accueil
                        </label>
                    </div>
                </div>  
                <x-form.submit color="primary" size="col-4 m-2 mt-4" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
