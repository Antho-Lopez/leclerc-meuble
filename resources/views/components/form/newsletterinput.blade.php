@props(['field', 'value' => null, 'type' => 'text', 'class' => null, 'step' => null, 'id' => $field])

<x-form.newslettergroup :field="$field">
    <input type={{ $type }} class="{{$class}} @error($field) is-invalid @enderror" id="{{ $id }}" name="{{ $field }}"
        placeholder="Votre E-mail" value="{{old($field) ?? $value}}" step="{{$step}}">
</x-form.group>
