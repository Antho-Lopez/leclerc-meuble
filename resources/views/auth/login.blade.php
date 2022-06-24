@extends('layouts.app')
@section('content')

@isset($url)
<div class="connexion-admin-bg pt-5">
@else
<div class="connexion-client-bg pt-5">
@endisset
<x-container>
    <div class="mb-2 p-0">
        <a href="{{ route('home') }}" class="btn los-andes btn-dark inscription-button col-lg-3 col-md-4 col-sm-4 col-6 text-white">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <div class="card-body shadow bg-light custom-padding-card d-flex flex-wrap">
        <div class="col-md-6 col-12">
        @isset($url)
            <form id="myForm" method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
        @else
            <form id="myForm" method="POST" action='{{ url("login") }}' aria-label="{{ __('Login') }}">
        @endisset
            @csrf
                <div class="los-andes mt-4 mb-5">
                    <p class="h1 text-center">Formulaire de connexion</p>
                </div>
                <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                    <div class="col-8">
                        <p class="align-self-end"><span class="text-danger">*</span> Champs obligatoires </p>
                    </div>
                    <div class="col-8">
                        <label for="email">{{ __('E-Mail') }}<span class="text-danger">*</span></label>

                        <div class="">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Entrez votre email" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                    <div class="col-8">
                        <label for="password">{{ __('Mot de passe ') }}<span class="text-danger">*</span></label>

                        <div>
                            <input id="password" type="password" class="los-andes form-control @error('password') is-invalid @enderror" name="password" placeholder="Entrez votre mot de passe" autocomplete="new-password">

                            @error('password')
                                <span class="los-andes invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-column">
                    @if (Route::has('password.request'))
                        <a class="los-andes btn btn-link ps-3" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <div class="d-flex align-items-center justify-content-center flex-row form-check">
                    <input class="me-1 form-check-input"  type="checkbox" id="remember" name="remember" value="remember">
                    <label class="mt-1 los-andes form-check-label" for="remember">Se souvenir de moi</label>
                </div>

                {{-- <x-form.checkbox label="Se souvenir de moi" field="remember" value="remember" class="m-1 los-andes"/> --}}
                <div class="d-flex align-items-center flex-column mb-5">
                    <button onclick="disableBtn()" id="myBtn" class="col-8 py-2 px-3 mt-3 btn bg-dark text-white front-menu-item los-andes text-center">Se connecter</button>
                </div>
            </form>
        </div>

        <div class="col-md-6 col-12" style='background-image: url("{{ asset('img/trames-univers-multimedia.jpg') }}");  background-repeat: no-repeat; background-size: cover; background-position: center;'>
            <div class="d-flex align-items-center justify-content-center flex-column mb-5">
                <div class="mt-5 col-10 d-flex flex-column align-items-center" style="background-color: rgb(33,37,41, 0.9);">
                    @empty($url)
                        <div class="los-andes mt-4 mb-5">
                            <p class="h1 text-white text-center">Nouveau client ?</p>
                        </div>
                        <p class="col-10 text-white los-andes">Cliquez ci-dessous pour créer votre compte client et ajouter des produits dans votre liste.</p>
                        <a href="{{ route('register') }}" class="mb-4 col-10 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">S'inscrire</a>
                    @else
                        <div class="los-andes mt-4 mb-5">
                            <p class="h1 text-white text-center">Inscription admin</p>
                        </div>
                        <p class="col-10 text-white los-andes">Cliquez ci-dessous pour créer votre compte admin.</p>
                        <a href="{{ route('registeradmin') }}" class="mb-4 col-10 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">S'inscrire</a>
                    @endisset
                </div>
            </div>
        </div>
    </div>

</x-container>
</div>
@endsection


















