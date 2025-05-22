@props([
    'name',
    'label' => '',
    'required' => false,
    'readonly' => false,
    'value' => '',
    'id' => null,  // Add this to allow for a custom ID
])

<div class="form-group">
    <label for="{{ $id ?? $name }}" class="form-label text-truncate d-block" style="width: 100%;" title="{{ $label }}">
    {{ $label }} @if($required)<span class="text-danger">*</span>@endif
</label>
    <input 
        type="text" 
        name="{{ $name }}" 
        id="{{ $id ?? $name }}"  
        class="form-control" 
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        @if($readonly) readonly @endif
        {{ $attributes }}
    >
</div>
