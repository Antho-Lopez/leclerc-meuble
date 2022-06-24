@extends('layouts.nav')

@section('content')
<x-container>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
        <a class="btn btn-success col-lg-2 col-md-4 col-sm-4 col-6" href="{{ route('category.create') }}">
            <i class="fas fa-plus-circle"></i>
            Ajouter une catégorie
        </a>
    </div>

    <x-card title="Liste des catégories">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nom</th>
                        <th scope="col">Sous-Catégories</th>
                        <th scope="col">Image d'entête</th>
                        <th scope="col" class="text-center">Modifier</th>
                        <th scope="col" class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <th class="text-center align-self-center">{{ $category->name }}</th>
                        <td>@foreach ($subcategories as $subcategory)
                            @if($category->id == $subcategory->category_id)
                                <p class="mb-1">-{{ $subcategory->subname }}</p>
                            @endif
                            @endforeach
                        </td>
                        <td class="text-center w-25"><img class="img-thumbnail w-75" src="{{ Storage::url($category->img_name) }}" alt="{{ $category->name }}"></td>
                        <td class="text-center"><a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Modifier</a></td> 
                        @if ($category->id != 1)
                            <td class="text-center"><a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger text-white" onclick="return confirm('êtes vous sur de vouloir supprimer cette catégorie ?')"><i class="fas fa-trash-alt me-1"></i>Supprimer</a></td>
                        @else
                            <td></td>
                        @endif
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="d-flex justify-content-center paginations">
            {{ $categories->links() }}
        </div>
    </x-card>
    </x-container>
@endsection
