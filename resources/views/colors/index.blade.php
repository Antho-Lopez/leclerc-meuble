@extends('layouts.nav')

@section('content')
<x-container>
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('color.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter une couleur
        </a>
    </div>
    <x-card title="Liste des couleurs">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col" class="text-center">Couleur</th>
                        <th scope="col" class="text-center">Modifier</th>
                        <th scope="col" class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($colors as $color)
                        @if ($color->id == 1)
                            <tr>
                                <th class="text-center">{{$color->name}}</th>
                                <td class="text-center"><div class="img-thumbnail" style='background: rgb(31,31,31); background: linear-gradient(90deg, rgba(31,31,31,1) 10%, rgba(222,222,222,1) 90%); width: 70%; height: 40px; margin-left: 15%'></div></td>
                                {{-- <td class="text-center"><div class="img-thumbnail" style='background: rgb(255,255,255);
                                    background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(124,78,40,1) 50%, rgba(0,0,0,1) 100%); width: 70%; height: 40px; margin-left: 15%'></div></td> --}}
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            <tr>
                                <th class="text-center">{{ $color->name }}</th>
                                <td class="text-center"><div class="img-thumbnail" style="background-color: {{ $color->color_code }}; width: 70%; height: 40px; margin-left: 15%"></div></td>
                                <td class="text-center"><a href="{{ route('color.edit', $color->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td>
                                <td class="text-center"><a href="{{ route('color.delete', $color->id) }}" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer cette couleur ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="d-flex justify-content-center paginations">
            {{ $colors->links() }}
        </div>
    </x-card>
    </x-container>
@endsection
