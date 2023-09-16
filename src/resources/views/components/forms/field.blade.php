@props([
    'name',
    'type',
    'errors',
    'value' => '',
    'class' => ['form-control form-control-sm'],
    'labelClass' => ['form-label mb-0'],
    'wrapperClass' => ['d-flex align-items-center gap-2'],
    'required' => false,
    'checked' => false,
    'label' => '',
    'placeholder' => '',
    'onKeyUp' => '',
    'maxlength' => '',
    'onchange' => '',
])

<div class="{{ implode(' ', (array) $wrapperClass) }}">
    @if ($label)
    <label for="{{ $name }}" class="{{ implode(' ', (array) $labelClass) }}" style="max-width: 70px; width: 100%">
        {{ $label }}
        @if($required)
        <span class="required"></span>
        @endif
    </label>
    @endif
    <div class="input-group">
        <input
            type="{{ $type }}"
            class="{{ implode(' ', (array) $class) }}"
            id="{{ $name }}" 
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            onKeyUp="{{ $onKeyUp }}"
            maxlength="{{ $maxlength }}"
            onchange="{{ $onchange }}"
        />
    </div>
    <x-forms.error-messages :errors="$errors" :name="$name"/>
</div>

<style>
    .required {
        position: relative;
    }
    .required::after {
        display: block;
        position: absolute;
        content: '*';
        font-size: 10px; 
        color: red;
        top: 0px;
        right: -10px;
    }
</style>