
    $(document).ready(function() {
    // When the Region is selected, reset other fields
        $('#place_of_birth_region').change(function() {
            var regionId = $(this).val();

        // Reset Province, Municipality, and Barangay fields
            $('#place_of_birth_province').empty().append('<option value="">Select Province</option>').prop('disabled', false);
            $('#place_of_birth_municipality').empty().append('<option value="">Select Municipality</option>').prop('disabled', true);
            $('#place_of_birth_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', true);

            if(regionId) {
            // If a region is selected, make an AJAX call to get the provinces
                $.ajax({
                url: '/get-provinces/' + regionId, // Modify this URL to match your route for getting provinces
                method: 'GET',
                success: function(data) {
                    // Populate the Province dropdown
                    data.provinces.forEach(function(province) {
                        $('#place_of_birth_province').append('<option value="' + province.province_id + '">' + province.province_name + '</option>');
                    });
                    $('#place_of_birth_province').prop('disabled', false);
                }
            });
            }
        });

    // When the Province is selected, reset Municipality and Barangay
        $('#place_of_birth_province').change(function() {
            var provinceId = $(this).val();

        // Reset Municipality and Barangay fields
            $('#place_of_birth_municipality').empty().append('<option value="">Select Municipality</option>').prop('disabled', false);
            $('#place_of_birth_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', true);

            if(provinceId) {
            // Make an AJAX call to get the municipalities
                $.ajax({
                url: '/get-municipalities/' + provinceId, // Modify this URL to match your route for getting municipalities
                method: 'GET',
                success: function(data) {
                    // Populate the Municipality dropdown
                    data.municipalities.forEach(function(municipality) {
                        $('#place_of_birth_municipality').append('<option value="' + municipality.municipality_id + '">' + municipality.municipality_name + '</option>');
                    });
                    $('#place_of_birth_municipality').prop('disabled', false);
                }
            });
            }
        });

    // When the Municipality is selected, reset Barangay
        $('#place_of_birth_municipality').change(function() {
            var municipalityId = $(this).val();

        // Reset Barangay field
            $('#place_of_birth_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', false);

            if(municipalityId) {
            // Make an AJAX call to get the barangays
                $.ajax({
                url: '/get-barangays/' + municipalityId, // Modify this URL to match your route for getting barangays
                method: 'GET',
                success: function(data) {
                    // Populate the Barangay dropdown
                    data.barangays.forEach(function(barangay) {
                        $('#place_of_birth_barangay').append('<option value="' + barangay.barangay_id + '">' + barangay.barangay_name + '</option>');
                    });
                    $('#place_of_birth_barangay').prop('disabled', false);
                }
            });
            }
        });
    });



    $(document).ready(function() {
    // When the Region is selected, reset other fields
    $('#residence_region').change(function() {
        var regionId = $(this).val();

        // Reset Province, Municipality, and Barangay fields
        $('#residence_province').empty().append('<option value="">Select Province</option>').prop('disabled', false);
        $('#residence_municipality').empty().append('<option value="">Select Municipality</option>').prop('disabled', true);
        $('#residence_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', true);

        if(regionId) {
            // If a region is selected, make an AJAX call to get the provinces
            $.ajax({
                url: '/get-provinces/' + regionId, // Modify this URL to match your route for getting provinces
                method: 'GET',
                success: function(data) {
                    // Populate the Province dropdown
                    data.provinces.forEach(function(province) {
                        $('#residence_province').append('<option value="' + province.province_id + '">' + province.province_name + '</option>');
                    });
                    $('#residence_province').prop('disabled', false);
                }
            });
        }
    });

    // When the Province is selected, reset Municipality and Barangay
    $('#residence_province').change(function() {
        var provinceId = $(this).val();

        // Reset Municipality and Barangay fields
        $('#residence_municipality').empty().append('<option value="">Select Municipality</option>').prop('disabled', false);
        $('#residence_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', true);

        if(provinceId) {
            // Make an AJAX call to get the municipalities
            $.ajax({
                url: '/get-municipalities/' + provinceId, // Modify this URL to match your route for getting municipalities
                method: 'GET',
                success: function(data) {
                    // Populate the Municipality dropdown
                    data.municipalities.forEach(function(municipality) {
                        $('#residence_municipality').append('<option value="' + municipality.municipality_id + '">' + municipality.municipality_name + '</option>');
                    });
                    $('#residence_municipality').prop('disabled', false);
                }
            });
        }
    });

    // When the Municipality is selected, reset Barangay
    $('#residence_municipality').change(function() {
        var municipalityId = $(this).val();

        // Reset Barangay field
        $('#residence_barangay').empty().append('<option value="">Select Barangay</option>').prop('disabled', false);

        if(municipalityId) {
            // Make an AJAX call to get the barangays
            $.ajax({
                url: '/get-barangays/' + municipalityId, // Modify this URL to match your route for getting barangays
                method: 'GET',
                success: function(data) {
                    // Populate the Barangay dropdown
                    data.barangays.forEach(function(barangay) {
                        $('#residence_barangay').append('<option value="' + barangay.barangay_id + '">' + barangay.barangay_name + '</option>');
                    });
                    $('#residence_barangay').prop('disabled', false);
                }
            });
        }
    });
});





    document.getElementById('birth_date').addEventListener('change', function () {
        const birthDate = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        document.getElementById('birth_date_age').value = age;
    });
