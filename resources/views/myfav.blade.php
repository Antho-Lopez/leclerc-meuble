@extends('layouts.frontnav')
@section('content')
<div>
    <div style='height: 50vh; margin-top: -10vh; background-image: url("{{ asset('img/trames-univers-multimedia.jpg') }}"); background-repeat: no-repeat; background-size: cover; background-position: center;'>
    </div>
    <p class="text-center my-4 h1 fw-bold">Gestion de vos favoris</p>
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
        <a href="{{ route('oneproduct', $product->id) }}" class="no-style-link scalehover shadow border col-lg-3 col-md-4 col-sm-4 col-10 d-flex flex-column align-items-center bg-white m-3 cursor-pointer">
            <div>
              <div>
                  @if(count($product->img_products) == 0)
                    <img class="img-fluid mb-2" src="{{asset('img/no-visuel.jpg')}}">
                  @endif
                  @foreach ($product->img_products as $img)
                    @if($img->is_first == 1)
                        <img class="img-fluid mb-2" src="{{ Storage::url('product/' . $product->id . '/'  . $img->id . '-' . 'miniature' . '-' . $img->img_name) }}" alt="{{ $img->name }}">
                    @endif
                  @endforeach
              </div>
            </div>
            <div class="col-12 justify-content-start align-items-start">
              <p class="align-self-start h4 pt-3 los-andes ms-3">{{ $product->name }}</p>
                <div class="col-11 ms-3 d-flex flex-row justify-content-between pb-1">
                  <div class="col-10">
                    <p class="casse text-muted">{{ substr($product->description, 0, 120)}} @if(strlen($product->description) > 120)..... @endif</p>
                  </div>

                  <div>
                    <div>
                        <x-form :route="route('product.remove_fav', [$product->id, Auth::user()->id])">
                            <button id="myBtn" onclick="disableBtn()" class="border-0 bg-none"><i class="far fa-trash-alt mt-3 fs-3" style="color: black"></i></button>
                        </x-form>
                    </div>
                  </div>
              </div>
            </div>
        </a>
        @endforeach
        @if (count($products) == 0)
            <div class="alert alert-info my-5" role="alert">
                Vous n'avez pas encore de produits dans votre liste de favoris
            </div>
        @endif

    </div>
</div>
@endsection
