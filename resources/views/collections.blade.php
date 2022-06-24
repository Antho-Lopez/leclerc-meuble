@extends('layouts.frontnav')
@section('content')

        <div class="d-flex mt-collection flex flex-column mb-5">
            {{-- @dd($inspirations) --}}
            <div class="custom-m align-self-center">
                <p class="text-center p-4 los-andes fs-collection-title">Découvrez nos dernières collections !</p>
            </div>
        
            <div class="d-flex flex-wrap justify-content-center custom-padding">
                @foreach ($inspirations as  $key => $inspiration)
                
                    <?php 
                        $space = str_replace('-', ' ', $inspiration->name);
                        $name = ucwords($space);
                    ?>
                    @if ($key % 2 == 0)
                    <div class="col-12 d-flex justify-content-center py-5" style="background-color: #cbaf99c7">
                        <div class="col-11 d-flex flex-wrap align-items-center justify-content-between">
                    @else
                    <div class="col-12 d-flex justify-content-center py-5">
                        <div class="col-11 d-flex flex-row-reverse flex-wrap-reverse align-items-center justify-content-between resp-wrap">
                    @endif
                            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                <img class="img-fluid img-thumbnail" src="{{ Storage::url($inspiration->img_name) }}" alt="{{ $inspiration->name }}">
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-12 d-flex flex-column align-items-center">
                                <p class="h1 pt-3 los-andes text-center fw-bold">{{ $name }}</p> 
                                <p class="casse h3 pt-3 crazymond text-center">"{{ $inspiration->description }}"</p> 
                                <a class="py-2 px-3 mt-3 btn bg-dark text-white front-menu-item los-andes text-center" href="{{ route('collectionproducts', $inspiration->id) }}">Voir les produits de cette collection</a>        
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
            <div class="d-flex justify-content-center paginations los-andes">
                {{ $inspirations->links() }}
            </div>
        </div>
@endsection
