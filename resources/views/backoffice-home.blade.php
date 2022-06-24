@extends('layouts.nav')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('category.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-grip-horizontal"></i>
                                <p class="pt-2 fs-3 text-center">Catégories</p>
                            </a>
                        </div>

                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('inspiration.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-star"></i>
                                <p class="pt-2 fs-3 text-center">Collections</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('brand.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-copyright"></i>
                                <p class="pt-2 fs-3 text-center">Marques</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('material.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-tree"></i>
                                <p class="pt-2 fs-3 text-center">Matériaux / Revetements</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('color.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-palette"></i>
                                <p class="pt-2 fs-3 text-center">Coloris</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('product.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-couch"></i>
                                <p class="pt-2 fs-3 text-center">Produits</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('dimension.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-expand-alt"></i>
                                <p class="pt-2 fs-3 text-center">Dimensions (literie)</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('social_media.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fab fa-facebook"></i>
                                <p class="pt-2 fs-3 text-center">Réseaux sociaux</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('img_global.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-images"></i>
                                <p class="pt-2 fs-3 text-center">Images</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('contact.show', 1) }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-phone"></i>
                                <p class="pt-2 fs-3 text-center">Informations de contact</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('shape.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-shapes"></i>
                                <p class="pt-2 fs-3 text-center">Formes</p>
                            </a>
                        </div>
                        <div class="gap-2 btn btn-primary col-lg-3 col-md-4 col-sm-8 col-10 m-1">
                            <a href="{{ route('statistic.index') }}" class="d-flex flex-column align-items-center text-decoration-none text-white pt-3">
                                <i style="font-size: 60px" class="fas fa-chart-bar"></i>
                                <p class="pt-2 fs-3 text-center">Statistiques</p>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
