
@extends('layouts.nav')

@section('content')
<x-container>
    
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('inspiration.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Ajout d'une nouvelle collection">
        
        <div class="card-body">
            <x-form files="true" :route="route('inspiration.store')">
                <x-form.input class="my-1" field="name" label="Nom *" />
                <x-form.text rows="5" class="my-1" field="description" label="Description" />
                <x-form.file field="img_name" label="Ajouter une photo *" class="mt-2" />
                <div class="form-check d-flex">
                    <div class="col-4">
                    </div>
                    <div class="ms-3 mt-3">
                        <input class="form-check-input" name="is_favorite" type="checkbox" value="1">
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
