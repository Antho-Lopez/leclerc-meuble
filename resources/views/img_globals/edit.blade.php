
@extends('layouts.nav')

@section('content')
<x-container>
    
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('img_global.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification de la Photo : {{ $img_global->name }}">
        
        <div class="card-body">
            <x-form files="true" :route="route('img_global.update', request()->route('id'))">
                <x-form.file field="img_name" label="Ajouter une photo *" class="mt-2" />
                <x-form.submit color="primary" size="col-4 m-2 mt-4" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
