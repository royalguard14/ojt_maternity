@props([
    'name',
    'label' => '',
    'required' => false,
    'value' => '',
    'id' => null, // Allow custom ID
])

@php
    $inputId = $id ?? $name; // Fallback to name if ID isn't provided
@endphp

<div class="form-group">
    <label for="{{ $inputId }}">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    <input 
        type="date" 
        name="{{ $name }}" 
        id="{{ $inputId }}" 
        class="form-control" 
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        {{ $attributes }}
    >
</div>
