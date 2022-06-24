@props(['field', 'label' => null])

<div class="form-group row">
    <x-form.label :field="$field" :label="$label" />
    <div class="col-md-6 d-flex flex-wrap">

        {{ $slot }}

        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>