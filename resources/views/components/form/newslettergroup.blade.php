@props(['field'])

<div>
    <div>
        {{ $slot }}
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>