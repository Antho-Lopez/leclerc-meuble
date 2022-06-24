@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('social_media.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter un réseau social
        </a>
    </div>
    <x-card title="Liste des liens">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Icone</th>
                        <th scope="col" class="text-center">Lien</th>
                        <th scope="col" class="text-center">Modifier</th>
                        <th scope="col" class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medias as $media)
                    <tr>
                        <th class="text-center">{{ $media->name }}</th>
                        <th class="text-center"><?= $media->img_name ?></th>
                        <th class="text-center"><a href="{{ $media->link }}" target="_blank" class="btn btn-primary"><i class="fas fa-eye me-1"></i>Voir le lien</a></th>
                        <td class="text-center"><a href="{{ route('social_media.edit', $media->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                        <td class="text-center"><a href="{{ route('social_media.delete', $media->id) }}" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer ce lien ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td> 
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </x-card>
    </x-container>
@endsection
