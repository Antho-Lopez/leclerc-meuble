@props(['field', 'label', 'value', 'checked' => null, 'id' => $field, 'class' => null])

<x-form.group :field="$field">
    <input class="form-check-input {{$class}}" type="checkbox" value="{{ $value }}" name="{{ $field }}" id="{{ $id }}" autocomplete="off" @if($checked) checked @endif>
    <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
</x-form.group>