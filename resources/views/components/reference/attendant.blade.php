<div>
    <label for="{{ $attributes->get('id') }}" class="form-label">
        {{ $attributes->get('label') ?? 'Attendant' }}
    </label>
    <select name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') ?? 'attendant' }}" class="form-control">
        <option value="">-- Select Attendant --</option>
        @foreach ($attendants as $code => $attendant)
            <option value="{{ $attendant }}" {{ $selected == $attendant ? 'selected' : '' }}>{{ $attendant }}</option>
        @endforeach
    </select>
</div>
