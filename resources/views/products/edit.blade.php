
@extends('layouts.nav')

@section('content')
<x-container>
    <div class="d-flex justify-content-center mb-2">
        <a href="{{ route('product.index') }}" class="btn btn-dark col-lg-2 col-md-4 col-sm-4 col-6 text-white me-2">
            <i class="fas fa-arrow-alt-circle-left"></i>
            Retour
        </a>
    </div>
    <x-card title="Modification d'un produit">

        <div class="card-body">
            <x-form files="true" :route="route('product.update',request()->route('id'))">
                <p class="h3 fw-bold text-center mt-4 mb-2">Informations</p>

                <x-form.input class="my-1" field="name" :value="$product->name" label="Nom *" />
                <p class="text-center h3 mt-2">Catégorie : {{ $category[0]->name }}</p>
                <p class="h4 mb-3">Sous-catégories :</p>
                <x-form.customcheckboxgroup label="Sous-catégories" :value="$product_subcategories->pluck('subcategory_id')->all()" field="subcategory_id" :values="$subcategories->pluck('subname','id')->all()" />
                <hr>
                <x-form.text class="my-1" rows="5" field="description" :value="$product->description" label="Description" />
                <x-form.text class="my-1" rows="5" field="details" :value="$product->details" label="Détails" />
                <x-form.input class="my-1" field="price" :value="$product->price" label="Prix" />
                <x-form.select class="my-1" field="brand_id" label="Marque" :values="$brands->pluck('name', 'id')" value="{{ $product->brand_id }}" />
                <x-form.input class="my-1" field="production" :value="$product->production" label="Production" />
                <x-form.file field="img_production" label="Modifier le visuel (drapeau)" class="my-1" />
                <div class="d-flex">
                    <div class="col-4">
                        <p>Image actuel : </p>
                    </div>
                    <div class="ms-3 mt-3">
                        <img class="w-25 img-fluid img-thumbnail" src="{{ Storage::url('product/' . $product->id . '/' . $product->img_production) }}" alt="{{ $product->img_production }}">
                    </div>
                </div>
                <hr>
                @if ($product->category_id == 1)
                <p class="h4 mb-3">Dimensions :</p>
                <x-form.customcheckboxgroup label="Dimensions" :value="$dimensions_product->pluck('dimension_id')->all()" field="dimension_id" :values="$dimensions->pluck('size','id')->all()" />
                <hr>
                @endif
                <p class="h4 mb-3">Couleurs :</p>
                <x-form.customcheckboxgroup label="Couleurs" :value="$colors_product->pluck('color_id')->all()" field="color_id" :values="$colors->pluck('name','id')->all()" />
                <hr>
                <p class="h4 mb-3">Matériaux / Revetements :</p>
                <x-form.customcheckboxgroup label="Matériaux / Revetements" :value="$materials_product->pluck('material_id')->all()" field="material_id" :values="$materials->pluck('name','id')->all()" />
                <hr>
                <p class="h4 mb-3">Technologies :</p>
                <x-form.customcheckboxgroup label="Technologies" :value="$technologies_product->pluck('technology_id')->all()" field="technology_id" :values="$technologies->pluck('name','id')->all()" />
                <hr>
                <p class="h4 mb-3">Types de produit:</p>
                <x-form.customcheckboxgroup label="Types de produit" :value="$types_product->pluck('type_id')->all()" field="type_id" :values="$types->pluck('name','id')->all()" />
                <hr>
                <p class="h4 mb-3">Formes :</p>
                <x-form.customcheckboxgroup label="Formes" :value="$shapes_product->pluck('shape_id')->all()" field="shape_id" :values="$shapes->pluck('name','id')->all()" />
                <hr>

                <x-form.files field="img_product[]" label="Ajouter des photos à ce produit ?" class="m-2" />

                @if (!$product->img_products->isEmpty())
                <div class="form-group row mb-2 mt-2">
                    <p class="col-md-4 col-form-label text-md-right">Supprimer une photo de ce produit ? </p>
                    <div class="ms-2 col-md-6 mt-3 d-flex flex-wrap">
                        @foreach ($product->img_products as $file)

                            @if (pathinfo($file->img_name)['extension'] == 'JPG' ||
                            pathinfo($file->img_name)['extension'] == 'PNG' ||
                            pathinfo($file->img_name)['extension'] == 'GIF' ||
                            pathinfo($file->img_name)['extension'] == 'jpg' ||
                            pathinfo($file->img_name)['extension'] == 'png' ||
                            pathinfo($file->img_name)['extension'] == 'gif'||
                            pathinfo($file->img_name)['extension'] == 'jpeg'||
                            pathinfo($file->img_name)['extension'] == 'JPEG')

                            <div class="me-2 col-md-2">
                                <div class="">
                                    <img class="img-thumbnail"
                                        src="{{ Storage::url('product/' . $product->id . '/'  . $file->id . '-' . $file->img_name) }}"
                                        alt="1">
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="filename_delete[]" value="{{$file->id}}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Supprimer
                                    </label>
                                </div>
                            </div>

                            @else
                            <div class="me-2 col-md-2">
                                <div>
                                    <span class="fas fa-paperclip"></span>
                                    <a href="{{ route('product.file', [$product->id, $file->id]) }}">{{ $file->img_name }}</a>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="filename_delete[]" value="{{$file->id}}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Supprimer
                                    </label>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_visible" id="flexCheckDefault"
                    @if($product->is_visible == 1)
                        checked
                    @endif
                    >
                    <label class="form-check-label" for="flexCheckDefault">
                    Afficher ce produit sur le site
                    </label>
                </div>

                <x-form.submit color="primary" size="col-4 m-2 mt-5" value="Valider" />
            </x-form>
        </div>

    </x-card>
</x-container>

@endsection
