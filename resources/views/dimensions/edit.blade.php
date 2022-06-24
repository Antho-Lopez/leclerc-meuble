
@extends('layouts.nav')

@section('content')
<x-container>
    
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('dimension.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'une dimension">
        
        <div class="card-body">
            <x-form :route="route('dimension.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>
                <x-form.input class="my-1" field="size" label="Nom du matériau / revetement *" :value="$dimension->size"/>
                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
