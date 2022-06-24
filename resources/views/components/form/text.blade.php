@props(['label', 'field', 'value' => null, 'rows' => 15, 'class' => null, 'placeholder' => null])

<x-form.group :label="$label" :field="$field">
    <textarea rows="{{ $rows }}" class="form-control {{ $class }} @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" placeholder="{{ $placeholder }}">{{old($field) ?? $value}}</textarea>
</x-form.group>