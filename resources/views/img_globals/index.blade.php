@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Liste des images">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($img_globals as $img_global)
                    <tr>
                        <th class="text-center">{{ $img_global->name }}</th>
                        <td class="text-center w-50"><img class="w-75" src="{{ Storage::url($img_global->img_name) }}" alt="{{ $img_global->name }}"></td>
                        <td class="text-center"><a href="{{ route('img_global.edit', $img_global->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </x-card>
    </x-container>
@endsection
