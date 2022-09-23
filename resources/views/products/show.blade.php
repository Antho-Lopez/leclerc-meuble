@extends('layouts.nav')

@section('content')

<x-container>
  <div class="d-flex justify-content-center mb-2">
    <a href="{{ route('product.index') }}" class="btn btn-dark col-lg-3 col-md-4 col-sm-4 col-6 text-white me-2">
        <i class="fas fa-arrow-alt-circle-left"></i>
        Retour
    </a>
    <a class="btn btn-warning col-lg-3 col-md-4 col-sm-4 col-6" href="{{ route('product.edit', $product->id) }}">
      <i class="fas fa-edit me-1"></i>
      Modifier les infos produit
    </a>
</div>
  <x-card title="Détail du produit : {{ $product->name }}">
    <div class="card-body">
        <p class="h3 pt-2 pb-2">Informations du produit</p>

        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
            <tbody>
              <tr>
                <th scope="row">Nom</th>
                <td>{{ $product->name }}</td>
              </tr>
              <tr>
                <th scope="row">Description</th>
                <td class="casse">{{ $product->description }} @if(!isset($product->description))<span class="text-muted">(vide) </span>@endif</td>
              </tr>
              <tr>
                <th scope="row">Détails</th>
                <td class="casse">{{ $product->details }} @if(!isset($product->details))<span class="text-muted">(vide) </span>@endif</td>
              </tr>
              <tr>
                <th scope="row">Marque</th>
                <td>@if(isset($product->brand_id)) {{ $product->brand->name }} @else <span class="text-muted">(vide) </span> @endif</td>
              </tr>
              <tr>
                <th scope="row">Prix</th>
                <td> @if(isset($product->price)) {{ $product->price }} € @else <span class="text-muted">(vide) </span> @endif</td>
              </tr>
              <tr>
                <th scope="row">Production</th>
                <td class="casse">{{ $product->production }} @if(!isset($product->production))<span class="text-muted">(vide) </span>@endif
                    <div class="ms-3 mt-3">
                        <img class="w-25 img-fluid img-thumbnail" src="{{ Storage::url('product/' . $product->id . '/' . $product->img_production) }}" alt="{{ $product->img_production }}">
                    </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Catégorie</th>
                @if ($product->category != null)
                    <td> @if(!isset($product->category->name))<span class="text-muted">(vide) </span> @endif {{ $product->category->name }}</td>
                @else
                    <td class="text-center text-danger">Catégorie supprimée</td>
                @endif
              </tr>
              <tr>
                <th scope="row">Sous-catégories</th>
                <td>/
                    @foreach ($product_subcategories as $product_subcategory)
                        {{ $product_subcategory }} /
                    @endforeach
                </td>
              </tr>

              @if ($product->category_id == 1)
              <tr>
                <th scope="row">Dimensions</th>
                <td>/
                    @foreach ($dimensions_product as $dimension_product)
                        {{ $dimension_product }} /
                    @endforeach
                </td>
              </tr>
              @endif
              <tr>
                <th scope="row">Couleurs</th>
                <td>
                    @foreach ($colors_product as $color_product)
                      <p class="img-thumbnail" style="background-color: {{ $color_product }}; width: 10%; height: 30px;"></p>
                    @endforeach
                </td>
              </tr>
              <tr>
                <th scope="row">Matériaux / Revetements</th>
                <td>/
                    @foreach ($materials_product as $material_product)
                        {{ $material_product }} /
                    @endforeach
                </td>
              </tr>
              <tr>
                <th scope="row">Technologies</th>
                <td>/
                    @foreach ($technologies_product as $technology_product)
                        {{ $technology_product }} /
                    @endforeach
                </td>
              </tr>
              <tr>
                <th scope="row">Types de produit</th>
                <td>/
                    @foreach ($types_product as $type_product)
                        {{ $type_product }} /
                    @endforeach
                </td>
              </tr>
              <tr>
                <th scope="row">Formes</th>
                <td>/
                    @foreach ($shapes_product as $shape_product)
                        {{ $shape_product }} /
                    @endforeach
                </td>
              </tr>
              <tr>
                <th scope="row">Photos (Modifiez la photo en favoris en cliquant sur l'étoile)</th>
                <td>
                    <div class="d-flex flex-wrap">
                      @foreach ($product->img_products as $img)
                      <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ Storage::url('product/' . $product->id . '/'  . $img->id . '-' . $img->img_name) }}" class="img-thumbnail" alt="{{ $img->img_name }}">
                        @if ($img->is_first == 1)
                          <i class="fas fa-star mt-3 fs-3" style="color: gold"></i>
                        @else
                          <x-form :route="route('product.manage_first',[request()->route('id'), $img->id])">
                            <button id="myBtn" onclick="disableBtn()" class="border-0 bg-none"><i class="far fa-star mt-3 fs-3" style="color: black"></i></button>
                          </x-form>
                        @endif
                      </div>
                      @endforeach
                    </div>
                </td>
              </tr>

            </tbody>
        </table>
    </div>
    </x-card>
</x-container>

<div style="margin-bottom: 100px">
  <p></p>
</div>

@endsection
