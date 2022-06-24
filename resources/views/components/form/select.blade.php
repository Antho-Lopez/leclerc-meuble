@props(['field', 'label', 'values', 'value' => null, 'class' => null])
<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="{{ $field }}">{{ $label }}</label>
    <div class="col-md-6 {{$class}}">
        <select class="form-select @error($field) is-invalid @enderror" name="{{ $field }}">
            @foreach ($values as $k => $v)
            <option value="{{$k}}" @if($k == (old($field) ?? $value)) selected @endif >{{ $v }}</option>
            @endforeach
        </select>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>