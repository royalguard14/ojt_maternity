<div>
    <label for="{{ $attributes->get('id') }}" class="form-label">{{ $attributes->get('label') ?? 'Occupation' }}</label>
    <select name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') ?? $attributes->get('name') }}" class="form-control">
        <option value="">-- Select Occupation --</option>
        @foreach ($occupations as $code => $label)
            <option value="{{ $label }}" {{ $selected == $label ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>
