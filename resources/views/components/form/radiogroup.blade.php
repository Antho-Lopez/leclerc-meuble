@props(['label', 'field', 'values', 'value' => []])
<x-form.group :label="$label" :field="$field">
    <div class="d-flex">
        @foreach ($values as $k => $v)
        @php
            $field_id = $field . '_' . $k;
            $field_name = $field;
            $is_checked = in_array($k, old($field) ?? $value)
        @endphp
            <x-form.radio :label="$v" :value="$k" :field="$field_name" :id="$field_id" :checked="$is_checked" />
        @endforeach
    </div>
</x-form.group>