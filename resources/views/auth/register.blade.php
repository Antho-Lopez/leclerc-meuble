@extends('layouts.app')
@section('content')

@isset($url)
<div class="inscription-admin-bg pt-5">
@else
<div class="inscription-client-bg pt-5">
@endisset

<x-container>
        <div class="mb-5">
            <div class="mb-2 p-0">
                <a href="{{ route('home') }}" class="btn los-andes btn-dark inscription-button col-lg-3 col-md-4 col-sm-4 col-6 text-white">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Retour
                </a>
            </div>

            <div class="card-body shadow bg-light custom-padding-card d-flex flex-wrap">
                <div class="col-md-6 col-12">
                    @isset($url)
                    <form id="myForm" method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                        <div class="los-andes mt-4 mb-5">
                            <p class="h1 text-center">Formulaire d'inscription admin</p>
                        </div>
                    @else
                    <form id="myForm" method="POST" action="{{ route('register') }}">
                        <div class="los-andes mt-4 mb-5">
                            <p class="h1 text-center">Formulaire d'inscription client</p>
                        </div>
                    @endisset

                        @csrf
                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom ') }}<span class="text-danger">*</span></label>

                                <div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Entrez votre nom" required autocomplete="family-name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Prenom ') }}<span class="text-danger">*</span></label>

                                <div>
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" placeholder="Entrez votre prénom" required autocomplete="given-name" autofocus>

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail ') }}<span class="text-danger">*</span></label>

                                <div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Entrez votre email" required autocomplete="email">

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
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe ') }}<span class="text-danger">*</span></label>

                                <div >
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Entrez votre mot de passe" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer votre mot de passe ') }}<span class="text-danger">*</span></label>

                                <div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmez votre mot de passe" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        @empty($url)

                        <hr>
                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>

                                <div>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Entrez votre numéro de téléphone" autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                                <div>
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Entrez votre adresse" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>

                                <div>
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Entrez votre ville" name="city" value="{{ old('city') }}" autocomplete="locality" autofocus>

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">
                            <div class="col-8">
                                <label for="cp" class="col-md-4 col-form-label text-md-right">{{ __('Code postal') }}</label>

                                <div>
                                    <input id="cp" type="text" class="form-control @error('cp') is-invalid @enderror" name="cp" value="{{ old('cp') }}" placeholder="Entrez votre code postal" autocomplete="postal_code" autofocus>

                                    @error('cp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-column mb-2">
                            <div class="col-8 d-flex align-items-center justify-content-center flex-row form-check">
                                <input class="me-1 form-check-input" type="checkbox" id="remember" name="remember" value="remember" required>
                                <label class="mt-1 los-andes form-check-label" for="remember">J'ai lu et j'accepte les <a href="{{ route('conditions') }}">conditions générales</a> de La Centrale ainsi que la <a href="{{ route('confidential') }}">politique de confidentialité.</a></label>
                            </div>
                        </div>
                        @endempty

                            <div class="d-flex align-items-center flex-column mb-5">
                                <button onclick="disableBtn()" id="myBtn" type="submit" class="col-8 py-2 px-3 mt-3 btn bg-dark text-white front-menu-item los-andes text-center">
                                    {{ __('S\'enregistrer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-12" style='background-image: url("{{ asset('img/trames-univers-multimedia.jpg') }}");  background-repeat: no-repeat; background-size: cover; background-position: center;'>
                        <div class="d-flex align-items-center justify-content-center flex-column mb-5">
                            <div class="mt-5 col-10 d-flex flex-column align-items-center" style="background-color: rgb(33,37,41, 0.9);">
                                @empty($url)
                                    <div class="los-andes mt-4 mb-5">
                                        <p class="h1 text-white text-center">Déjà inscrit ?</p>
                                    </div>
                                    <p class="col-10 text-white los-andes">Cliquez ci-dessous pour vous connecter à votre compte client et ajouter des produits dans votre liste.</p>
                                    <a href="{{ route('login') }}" class="mb-4 col-10 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">Se connecter</a>
                                @else
                                    <div class="los-andes mt-4 mb-5">
                                        <p class="h1 text-white text-center">Déjà inscrit ?</p>
                                    </div>
                                    <p class="col-10 text-white los-andes">Cliquez ci-dessous pour vous connecter à votre compte admin.</p>
                                    <a href="{{ route('loginadmin') }}" class="mb-4 col-10 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">Se connecter</a>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-container>
</div>
@endsection
