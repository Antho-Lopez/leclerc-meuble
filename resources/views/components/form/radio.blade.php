@props(['field', 'label', 'value', 'checked' => null, 'id' => $field, 'class' => null])

<x-form.group :field="$field">
    <div class="mx-5 text-center">
        <input class="form-check-input {{$class}}" type="radio" value="{{ $value }}" name="{{ $field }}" id="{{ $id }}" autocomplete="off" @if($checked) checked @endif required>
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    </div>
</x-form.group>

