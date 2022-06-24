@props(['label', 'field', 'value' => null, 'class' => null])

<x-form.group :label="$label" :field="$field">
    <input multiple accept=".png, .jpg, .jpeg" type="file" class="form-control {{$class}}  @error($field) is-invalid @enderror" name="{{ $field }}" id="addFile">
</x-form.group>

