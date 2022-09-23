@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>

    <x-card title="Liste des catégories">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col">Image d'entête</th>
                        <th scope="col" class="text-center">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogs as $catalog)
                    <tr>
                        <th class="text-center align-self-center">{{ $catalog->name }}</th>
                        <td class="text-center w-25"><img class="img-thumbnail w-75" src="{{ Storage::url($catalog->img_name) }}" alt="{{ $catalog->name }}"></td>
                        <td class="text-center"><a href="{{ route('catalog.edit', $catalog->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </x-card>
    </x-container>
@endsection
