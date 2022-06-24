@props(['field', 'label' => null])

<div class="d-flex justify-content-md-center">
    <div class="form-group row col-12">

        {{ $slot }}

        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
</div>