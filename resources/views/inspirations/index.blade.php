@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('inspiration.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter une collection
        </a>
    </div>
    <x-card title="Liste des collections">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Collection</th>
                        <th scope="col" class="text-center">Est en favoris</th>
                        <th scope="col" class="text-center">Voir</th>
                        <th scope="col" class="text-center">Modifier</th>
                        <th scope="col" class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inspirations as $inspiration)
                        <tr>
                            <?php 
                                $transformed = str_replace('-', ' ', $inspiration->name)
                            ?>
                            <th class="col-2 text-center">
                                <div class="">
                                    <p>{{ ucwords($transformed) }}</p>
                                    <img class="w-100 img-fluid img-thumbnail" src="{{Storage::url($inspiration->img_name) }}" alt="{{ $inspiration->name }}">
                                </div>
                            </th>
                            @if($inspiration->is_favorite == 1)
                                <td class="text-success text-center">✔</td>
                            @else 
                                <td class="text-danger text-center">✖</td>
                            @endif
                            
                            <td class="text-center"><a href="{{ route('inspiration.show', $inspiration->id) }}" class="btn btn-primary"><i class="fas fa-eye me-1"></i>Voir</a></td>
                            <td class="text-center"><a href="{{ route('inspiration.edit', $inspiration->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                            <td class="text-center"><a href="{{ route('inspiration.delete', $inspiration->id) }}" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer cette collection ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td> 
                        </tr>
                    
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="d-flex justify-content-center paginations">
            {{ $inspirations->links() }}
        </div>
    </x-card>
    </x-container>
@endsection
