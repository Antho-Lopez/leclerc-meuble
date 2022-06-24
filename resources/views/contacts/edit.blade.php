@extends('layouts.nav')

@section('content')
<x-container>
    
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('contact.show', 1) }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification des informations de contact">
        
        <div class="card-body">
            <x-form :route="route('contact.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations de contact</p>
                <x-form.input class="my-1" field="email" label="Email *" :value="$contact->email"/>
                <x-form.input class="my-1" field="phone" label="Téléphone *" :value="$contact->phone"/>
                <x-form.input class="my-1" field="address" label="Adresse *" :value="$contact->address"/>
                <x-form.input class="my-1" field="cp" label="Code postal *" :value="$contact->cp"/>
                <x-form.input class="my-1" field="city" label="Ville *" :value="$contact->city"/>
                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection