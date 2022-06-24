@extends('layouts.app')

@section('content')
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
                        <div class="mt-5 col-10 mb-5 text-white text-center pt-3" style="background-color: rgb(33,37,41, 0.9);">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Un lien de vérification vient d\'être envoyé sur votre mail.') }}
                                </div>
                            @endif

                            {{ __('Avant de continuer, veuillez vérifier votre boite mail pour le lien de vérification') }}
                            {{ __('Si vous n\'avez pas reçu le mail') }},
                            <form id="myForm" class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <div class="col-12 d-flex justify-content-center">
                                    <button onclick="disableBtn()" id="myBtn" type="submit" class="mb-4 col-6 py-2 px-3 mt-3 btn bg-light inscription-button los-andes text-center">{{ __('Cliquez ici pour recevoir un autre mail') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
