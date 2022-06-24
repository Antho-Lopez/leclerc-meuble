
@extends('layouts.hidden')

@section('content')
<x-container>
    <x-form files="true" :route="route('inspiration.manage_favorite_store')">
        <x-card>
            <div class="modal-header">
                <h5 class="modal-title">Limite de collection sur l'accueil atteint<br>
                    <span class="fs-6">Veuillez retirer une collection de l'accueil.</span>
                </h5>   
            </div>
            <div class="d-flex flex-row flex-wrap">
                @foreach ($favorite_inspirations as $favorite_inspiration) 
                <?php 
                $space = str_replace('-', ' ', $favorite_inspiration->name)
                ?>

                <div class="form-check col-4">
                    <div class="">
                        <label class="style-check">{{ ucwords($space) }}
                        <input type="radio" name="id" value="{{$favorite_inspiration->id}}" required>
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>  
                @endforeach
            </div>
            <div class="modal-footer">  
                <x-form.submit color="btn btn-primary" value="Enlever cette collection de l'accueil" />
            </div>
        </x-card>
    </x-form>
</x-container>

@endsection