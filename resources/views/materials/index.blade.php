@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('material.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter un matériau / revetement
        </a>
    </div>
    <x-card title="Liste des matériaux / Revetements">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Modifier</th>
                        <th scope="col" class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                    <tr>
                        <th class="text-center">{{ $material->name }}</th>
                        <td class="text-center"><a href="{{ route('material.edit', $material->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                        <td class="text-center"><a href="{{ route('material.delete', $material->id) }}" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer ce matériau ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td> 
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="d-flex justify-content-center paginations">
            {{ $materials->links() }}
        </div>
    </x-card>
    </x-container>
@endsection
