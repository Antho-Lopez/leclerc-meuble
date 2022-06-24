@props(['field', 'label', 'value', 'checked' => null, 'id' => $field, 'class' => null])

<x-form.customgroup :field="$field">
        <label class="style-check-2" for="{{ $id }}">{{ $label }}
            <input class=" {{$class}}" type="checkbox" value="{{ $value }}" name="{{ $field }}" id="{{ $id }}" autocomplete="off" @if($checked) checked @endif>
            <span class="checkmark"></span>
        </label>
</x-form.customgroup>