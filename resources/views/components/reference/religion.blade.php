<div>
    <label for="{{ $attributes->get('id') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <select name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') }}" class="form-control">
        <option value="">-- Select Religion --</option>
        @foreach ($religions as $religion)
            <option value="{{ $religion }}" {{ $selected == $religion ? 'selected' : '' }}>{{ $religion }}</option>
        @endforeach
    </select>
</div>
