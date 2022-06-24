@extends('layouts.nav')

@section('content')
<x-container>
    <component :is="'script'" src="/js/statsMeuble.js"></component>

    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('backoffice-home') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Statistiques">
            <div class="d-flex flex-column align-items-center">
                <p class="text-center h2 m-4">Personnalisez votre recherche</p>
                <div class="col-8 mt-2">
                    <x-form.input type="date" field="start_date" label="Date de début" class="m-2" id="start_date" value="{{ date_format(new Datetime('first day of this month'), 'Y-m-d') }}" />
                </div>
                <div class="col-8">
                    <x-form.input type="date" field="end_date" label="Date de fin" class="m-2" id="end_date" value="{{ date_format(new Datetime('today'), 'Y-m-d') }}" />
                </div>
                <div class="col-8 d-flex flex-row">
                    <div class="col-4">
                        <label class="col-form-label">Nombre de résultats maximum par graphiques</label>
                    </div>
                    <div class="col-3 ms-3">
                        <select class="form-select" id="nb_max">
                            <option value=10>--Choisissez un nombre--</option>
                            <option value=10>10</option>
                            <option value=20>20</option>
                            <option value=30>30</option>
                            <option value=50>50</option>
                            <option value=100>100</option>
                        </select>
                    </div>
                </div>
            </div>
        <div>
            <hr>
            <p class="text-center h2 m-4">Nombre de visites par catégories</p>
            <div class="container">
                <canvas id="clickpercategory"></canvas>
            </div>
        </div>

        <div>
            <hr>
            <p class="text-center h2 m-4">Nombre de visites par collections</p>
            <div class="container">
                <canvas id="clickpercollection"></canvas>
            </div>
        </div>

        <div>
            <hr>
            <p class="text-center h2 m-4">Nombre de visites par produits</p>

            <div class="d-flex flex-column align-items-center">
                <div class="col-6">
                    <select class="form-select" id="popularity">
                        <option value=0>--Trier par--</option>
                        <option value=1>Les produits les moins populaires</option>
                        <option value=0>Les produits les plus populaires</option>
                    </select>
                </div>
            </div>

            <div class="container">
                <canvas id="clickperproduct"></canvas>
            </div>
        </div>

    </x-card>
    </x-container>
@endsection
