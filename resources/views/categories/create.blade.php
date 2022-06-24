
@extends('layouts.nav')

@section('content')
<x-container>
    
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('category.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
      </div>
    <x-card title="Ajout d'une nouvelle catégorie">
        
        <div class="card-body">
            <x-form files="true" :route="route('category.store')">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>
                    
                    <category-create></category-create>
                    <x-form.file field="img_name" label="Ajouter une photo" class="mt-4" />

                <x-form.submit color="primary" size="col-4 m-2 mt-4" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
