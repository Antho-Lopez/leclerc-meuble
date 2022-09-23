@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Liste des inscrits à la newsletter">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">email</th>
                        <th scope="col" class="text-center">date d'inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsletters as $newsletter)
                    <tr>
                        <th class="text-center">{{ $newsletter->email }}</th>
                        <th class="text-center">{{ $newsletter->created_at->format('d/m/Y')}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <div class="m-4 d-flex flex-column align-items-center">
            <p class="h3">Format pour envoyer un mail groupé</p>
            <p>Collez le text ci-dessous dans la partie "envoyer à"</p>
            @foreach ($newsletters as $newsletter)
                {{$newsletter->email}};
            @endforeach
        </div>
    </x-card>
    </x-container>
@endsection
