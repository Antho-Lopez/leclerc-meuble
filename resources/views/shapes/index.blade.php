@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('shape.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter une forme
        </a>
    </div>
    <x-card title="Liste des formes">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col" class="text-center">Modifier</th>
                        <th scope="col" class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shapes as $shape)
                    <tr>
                        <th class="text-center">{{ $shape->name }}</th>
                        <td>
                            <div class="d-flex justify-content-center">
                                <img class="w-25 img-fluid img-thumbnail" src="{{Storage::url($shape->img_name) }}" alt="{{ $shape->name }}">
                            </div>
                        </td>
                        <td class="text-center"><a href="{{ route('shape.edit', $shape->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                        <td class="text-center"><a href="{{ route('shape.delete', $shape->id) }}" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer cette forme ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="d-flex justify-content-center paginations">
            {{ $shapes->links() }}
        </div>
    </x-card>
    </x-container>
@endsection
