@props([
    'name',
    'label' => '',
    'required' => false,
    'readonly' => false,
    'value' => '',
    'min' => null,
    'max' => null,
    'step' => '1',
])

<div class="form-group">
    <label for="{{ $attributes->get('id', $name) }}">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    <input 
        type="number" 
        name="{{ $name }}" 
        id="{{ $attributes->get('id', $name) }}" 
        class="form-control" 
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        @if($readonly) readonly @endif
        @if($min) min="{{ $min }}" @endif
        @if($max) max="{{ $max }}" @endif
        @if($step) step="{{ $step }}" @endif
        {{ $attributes }}
    >
</div>
