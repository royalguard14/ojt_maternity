@props(['prefix', 'regions'])

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="{{ $prefix }}_region">Region</label>
            <select id="{{ $prefix }}_region" name="{{ $prefix }}_region" class="form-control">
                <option value="">Select Region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="{{ $prefix }}_province">Province</label>
            <select id="{{ $prefix }}_province" name="{{ $prefix }}_province" class="form-control" disabled>
                <option value="">Select Province</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="{{ $prefix }}_municipality">Municipality</label>
            <select id="{{ $prefix }}_municipality" name="{{ $prefix }}_municipality" class="form-control" disabled>
                <option value="">Select Municipality</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="{{ $prefix }}_barangay">Barangay</label>
            <select id="{{ $prefix }}_barangay" name="{{ $prefix }}_barangay" class="form-control" disabled>
                <option value="">Select Barangay</option>
            </select>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        function setupLocationSelect(prefix) {
            // When Region is selected, reset other fields and populate provinces
            $('#' + prefix + '_region').change(function() {
                var regionId = $(this).val();

                // Reset Province, Municipality, and Barangay fields
                $('#' + prefix + '_province').empty().append('<option value="">Select Province</option>').prop('disabled', false);
                $('#' + prefix + '_municipality').empty().append('<option value="">Select Municipality</option>').prop('disabled', true);
                $('#' + prefix + '_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', true);

                if(regionId) {
                    $.ajax({
                        url: '/get-provinces/' + regionId,
                        method: 'GET',
                        success: function(data) {
                            data.provinces.forEach(function(province) {
                                $('#' + prefix + '_province').append('<option value="' + province.province_id + '">' + province.province_name + '</option>');
                            });
                            $('#' + prefix + '_province').prop('disabled', false);
                        }
                    });
                }
            });

            // When Province is selected, reset Municipality and Barangay
            $('#' + prefix + '_province').change(function() {
                var provinceId = $(this).val();

                $('#' + prefix + '_municipality').empty().append('<option value="">Select Municipality</option>').prop('disabled', false);
                $('#' + prefix + '_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', true);

                if(provinceId) {
                    $.ajax({
                        url: '/get-municipalities/' + provinceId,
                        method: 'GET',
                        success: function(data) {
                            data.municipalities.forEach(function(municipality) {
                                $('#' + prefix + '_municipality').append('<option value="' + municipality.municipality_id + '">' + municipality.municipality_name + '</option>');
                            });
                            $('#' + prefix + '_municipality').prop('disabled', false);
                        }
                    });
                }
            });

            // When Municipality is selected, reset Barangay
            $('#' + prefix + '_municipality').change(function() {
                var municipalityId = $(this).val();

                $('#' + prefix + '_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', false);

                if(municipalityId) {
                    $.ajax({
                        url: '/get-barangays/' + municipalityId,
                        method: 'GET',
                        success: function(data) {
                            data.barangays.forEach(function(barangay) {
                                $('#' + prefix + '_barangay').append('<option value="' + barangay.barangay_id + '">' + barangay.barangay_name + '</option>');
                            });
                            $('#' + prefix + '_barangay').prop('disabled', false);
                        }
                    });
                }
            });
        }

        // Initialize the location select setup for both place of birth and residence
        setupLocationSelect('{{ $prefix }}');


    });
</script>
