
@extends('layouts.nav')

@section('content')
<x-container>
    
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('social_media.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'un réseau social">
        
        <div class="card-body">
            <x-form :route="route('social_media.update', request()->route('id'))">
                <x-form.input class="my-1" field="name" label="Nom *" :value="$media->name" />
                <x-form.input class="my-1" field="link" label="Lien *" :value="$media->link" />
                <x-form.input class="my-1" field="img_name" label="Logo *"  :value="$media->img_name" />
                <div>
                    <p class="m-0 mt-2">Choisir un logo dans cette bibliothèque: <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank">Lien vers les logos</a></p>
                    <p>Utiliser le code qui ressemble à cet exemple <code class="fst-italic">{{'<i class="fas fa-home"></i>'}}</code> et collez le dans le champs "Logo"</p>
                </div>

                <x-form.submit color="primary" size="col-4 m-2 mt-4" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
