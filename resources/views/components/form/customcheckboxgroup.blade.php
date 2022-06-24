@props(['label', 'field', 'values', 'value' => []])
<x-form.customgroup :label="$label" :field="$field">
    @foreach ($values as $k => $v)
    @php
        $field_id = $field . '_' . $k;
        $field_name = $field . '[]';
        $is_checked = in_array($k, old($field) ?? $value)
    @endphp
        <div class="col-12 col-md-6 col-lg-4 ps-5">
            <x-form.customcheckbox :label="$v" :value="$k" :field="$field_name" :id="$field_id" :checked="$is_checked" />
        </div>
    @endforeach
</x-form.customgroup>