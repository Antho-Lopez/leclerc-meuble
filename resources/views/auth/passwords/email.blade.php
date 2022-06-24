@extends('layouts.app')

@section('content')
<div class="connexion-client-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="mt-4 col-md-8">
                <div class="mb-2 p-0">
                    <a href="{{ route('home') }}" class="btn los-andes btn-dark inscription-button col-lg-3 col-md-4 col-sm-4 col-6 text-white">
                        <i class="fas fa-arrow-alt-circle-left"></i>
                        Retour
                    </a>
                </div>
                <div>
                    <div class="card-body shadow custom-padding-card" style='background-image: url("{{ asset('img/trames-univers-multimedia.jpg') }}");  background-repeat: no-repeat; background-size: cover; background-position: center;'>
                        <div class="d-flex align-items-center justify-content-center flex-column mb-5">
                            <div class="mt-5 col-10 mb-5" style="background-color: rgb(33,37,41, 0.9);">
                                <p class="text-center text-white mt-2 fs-4">Saisissez votre e-mail pour réinitialiser votre mot de passe.</p>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form id="myForm" method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="los-andes form-group column m-2 d-flex align-items-center flex-column">

                                        <div class="col-8 text-white">
                                            <label for="email">{{ __('Adresse E-Mail') }}<span class="text-danger">*</span></label>

                                            <div>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 d-flex justify-content-center">
                                            <button onclick="disableBtn()" id="myBtn" type="submit" class="mb-4 col-6 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">
                                                {{ __('Réinitialiser mon mot de passe') }}
                                            </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
