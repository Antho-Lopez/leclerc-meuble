@props(['label' => null, 'field', 'value' => null, 'type' => 'text'])

<div class="form-group row justify-content-between mt-4 mb-4">
        <input type={{ $type }} class="form-control p-2 col-5 @error($field) is-invalid @enderror" id="{{ $field }}"
            name="{{ $field }}" placeholder="Entrer le nom du produit" value="{{old($field) ?? $value}}">
        <input type={{ $type }} class="form-control p-2 col-2 @error($field) is-invalid @enderror" id="{{ $field }}"
            name="{{ $field }}" placeholder="Entrer le prix" value="{{old($field) ?? $value}}">
        <input type={{ $type }} class="form-control p-2 col-2 @error($field) is-invalid @enderror" id="{{ $field }}"
            name="{{ $field }}" placeholder="Entrer la quantité" value="{{old($field) ?? $value}}">
        <select class="form-control p-2 col-2" name="">
            <option selected value="kg">Kg</option>
            <option value="unité">Unité</option>
        </select>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
