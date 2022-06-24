@extends('layouts.frontnav')
@section('content')


<div class="modification-client-bg pt-5 mt-5">
<x-container>
    <div class="mb-2 p-0">
        <a href="{{ route('home') }}" class="btn los-andes btn-dark inscription-button col-lg-3 col-md-4 col-sm-4 col-6 text-white">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <div class="card-body shadow bg-light custom-padding-card d-flex flex-wrap">
        <div class="col-md-6 col-12">

            <x-form :route="route('user.update', request()->route('id'))">
                <div class="los-andes mt-4 mb-5">
                    <p class="h1 text-center">Modification de vos informations</p>
                </div>

                <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                    <div class="col-8">
                        <p class="align-self-end"><span class="text-danger">*</span> Champs obligatoires </p>
                    </div>

                    <div class="col-8">
                        <x-form.input class="my-1" field="name" label="Nom *" :value="$user->name"/>
                        <x-form.input class="my-1" field="firstname" label="Prénom *" :value="$user->firstname"/>
                        <x-form.input class="my-1" field="phone" label="Téléphone" :value="$user->phone"/>
                        <x-form.input class="my-1" field="address" label="Adresse" :value="$user->address"/>
                        <x-form.input class="my-1" field="city" label="Ville" :value="$user->city"/>
                        <x-form.input class="my-1" field="cp" label="Code postale" :value="$user->cp"/>
                    </div>

                    <div class="d-flex align-items-center flex-column">
                        @if (Route::has('password.request'))
                            <a class="los-andes btn btn-link ps-3" href="{{ route('password.request') }}">
                                Changer mon mot de passe ?
                            </a>
                        @endif
                    </div>

                    <div class="d-flex align-items-center flex-column mb-5">
                        <button onclick="disableBtn()" id="myBtn" class="col-12 py-2 px-3 mt-3 btn bg-dark text-white front-menu-item los-andes text-center">Valider les changements</button>
                    </div>
                </div>
            </x-form>
        </div>
        <div class="col-md-6 col-12" style='background-image: url("{{ asset('img/trames-univers-multimedia.jpg') }}");  background-repeat: no-repeat; background-size: cover; background-position: center;'>
            <div class="d-flex align-items-center justify-content-center flex-column mb-5">
                <div class="mt-5 col-10 d-flex flex-column align-items-center" style="background-color: rgb(33,37,41, 0.9);">

                        <div class="los-andes mt-4 mb-5">
                            <p class="h1 text-white text-center">Ajouter des produits dans votre liste ?</p>
                        </div>
                        <p class="col-10 text-white los-andes">Cliquez ci-dessous pour voir les produits de la dernière collection et les ajouter dans votre liste.</p>
                        <a href="{{ route('collectionproducts', $last_collection->id) }}" class="mb-4 col-10 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">Voir les produits</a>
                </div>
            </div>
        </div>
    </div>
</x-container>
</div>
@endsection


















