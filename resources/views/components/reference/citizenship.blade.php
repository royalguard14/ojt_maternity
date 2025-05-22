<div>
    <label for="{{ $attributes->get('id') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <select name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') }}" class="form-control">
        <option value="">-- Select Citizenship --</option>
        @foreach ($citizenships as $code => $label)
            <option value="{{ $label }}" {{ $selected == $code ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>
