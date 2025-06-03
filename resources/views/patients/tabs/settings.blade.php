<!-- Settings Tab -->
<div class="tab-pane fade" id="custom-tabs-one-mc" role="tabpanel" aria-labelledby="custom-tabs-one-mc-tab">
    <form action="{{ route('patients.updateMC', $relationship->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Is Married Checkbox -->
    <div class="form-group">
        <label for="is_married">Married?</label><br>
        <input type="checkbox" name="is_married" id="is_married" value="1" {{ $relationship->is_married ? 'checked' : '' }}>
    </div>

    <!-- Date of Marriage -->
    <div class="form-group">
        <label for="date_of_marriage">Date of Marriage</label>
        <input type="date" class="form-control" name="date_of_marriage" id="date_of_marriage" value="{{ old('date_of_marriage', $relationship->date_of_marriage) }}">
    </div>

    <!-- Place of Marriage -->
    <div class="form-group">
        <label for="place_of_marriage">Place of Marriage</label>
        <input type="text" class="form-control" name="place_of_marriage" id="place_of_marriage" value="{{ old('place_of_marriage', $relationship->place_of_marriage) }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

</div>