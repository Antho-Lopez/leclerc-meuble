@props(['label' => null, 'field', 'value' => null, 'type' => 'text', 'class' => null, 'step' => null, 'id' => $field])

<x-form.group :label="$label" :field="$field">
    <input type={{ $type }} class="form-control {{$class}} @error($field) is-invalid @enderror" id="{{ $id }}" name="{{ $field }}"
        placeholder="Entrez {{ $label }}" value="{{old($field) ?? $value}}" step="{{$step}}">
</x-form.group>