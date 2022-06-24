
@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('category.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'une catégorie">
        
        <div files="true" class="card-body">
            <x-form :route="route('category.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>

                    <category-edit category="{{$category}}"></category-edit>
                    
                    <hr>
                    <div class="mt-4">
                        <x-form.file field="img_name" label="Modifier la photo" class="" />
                    </div>
                    
                    <div class="d-flex">
                        <div class="col-4">
                            <p>Image actuel : </p>
                        </div>
                        <div class="ms-3 mt-3">
                            <img class="w-25 img-fluid img-thumbnail" src="{{Storage::url($category->img_name) }}" alt="{{ $category->name }}">
                        </div>
                    </div>  
                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
