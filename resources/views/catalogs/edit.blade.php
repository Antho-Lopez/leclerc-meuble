
@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('catalog.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'un visuel d'accueil">

        <div files="true" class="card-body">
            <x-form :route="route('catalog.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>

                    <x-form.input class="my-1" field="name" label="Nom" :value="$catalog->name"/>
                    <x-form.input class="my-1" field="link" label="Lien vers le site" :value="$catalog->link"/>
                    <div class="mt-4">
                        <x-form.file field="img_name" label="Modifier la photo" class="" />
                    </div>
                    <div class="d-flex">
                        <div class="col-4">
                            <p>Image actuel : </p>
                        </div>
                        <div class="ms-3 mt-3">
                            <img class="w-25 img-fluid img-thumbnail" src="{{Storage::url($catalog->img_name) }}" alt="{{ $catalog->name }}">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_on_home" id="flexCheckDefault"
                                @if($catalog->is_on_home == 1)
                                    checked
                                @endif
                                >
                                <label class="form-check-label" for="flexCheckDefault">
                                Afficher sur l'accueil
                                </label>
                            </div>

                        </div>
                    </div>

                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
