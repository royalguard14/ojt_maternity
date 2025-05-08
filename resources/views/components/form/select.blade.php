@props([
    'name',
    'label' => '',
    'options' => [],
    'required' => false,
    'disabled' => false,
    'selected' => '',
])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes }}
    >
        <option value="">Select {{ $label }}</option>
        @foreach($options as $key => $value)
            <option value="{{ $key }}" @selected(old($name, $selected) == $key)>{{ $value }}</option>
        @endforeach
    </select>
</div>

