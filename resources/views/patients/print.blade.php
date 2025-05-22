@php
    use Carbon\Carbon;

    $setup = \App\Models\PrinterSetup::find(1);
    $positions = $setup?->printer_setting ?? [];

    $birthDate = $child->birth_date ? Carbon::parse($child->birth_date) : null;
    $marriageDate = $relationship->date_of_marriage ? Carbon::parse($relationship->date_of_marriage) : null;

    $placeOfMarriage = $relationship->place_of_marriage ?? '';
    $placeParts = explode('|', $placeOfMarriage);

    $now = Carbon::now();
    $formattedDate = $now->format('F j, Y'); // e.g. February 27, 2025
    $formattedTime = $now->format('g:i A');  // e.g. 4:00 AM
    $formattedTime = str_replace(['AM', 'PM'], ['A.M.', 'P.M.'], $formattedTime);

    $fatherFullName = trim($father->first_name . ' ' . ($father->middle_name ? $father->middle_name[0] . '.' : '') . ' ' . $father->last_name);
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Print Template with Auto Fit</title>
    <style>
        @page {
            size: 8.385826772in 14in;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            width: 816px;   /* 8.5in x 96dpi */
            height: 1344px; /* 14in x 96dpi */
            font-family: 'Times New Roman', Times, serif;
            position: relative;
            background: white;
        }
        .label-field {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-family: "Times New Roman", serif;
            font-size: 14px;
            line-height: 1;
            : 24px;
            background-color: rgba(255, 255, 0, 0.1);
            border: 1px dashed #bbb;
        }
        .label-field .auto-fit {
            display: inline-block;
            font-size: 14px;
            line-height: 1;
            white-space: nowrap;
            max-width: 100%;
            text-align: center;
            text-transform: uppercase;
        }
        /* Add dynamic positions */



@foreach($positions as $class => $style)
.{{ $class }} {
    top: {{ floatval($style['top'] ?? 0) - 17.00787402 }}px;
    left: {{ floatval($style['left'] ?? 0) }}px;
    width: {{ is_numeric($style['width']) ? $style['width'] . 'px' : ($style['width'] ?? 'auto') }};
height: {{ $style['height'] ?? '20px' }};
}
@endforeach




    </style>
</head>
<body>

    {{-- Child info --}}
    <div class="label-field province"><span class="auto-fit">{{ optional($child->birthProvince)->province_name ?? 'N/A' }}</span></div>
    <div class="label-field city"><span class="auto-fit">{{ optional($child->birthCity)->municipality_name ?? 'N/A' }}</span></div>
    <div class="label-field c_firstname"><span class="auto-fit">{{ $child->first_name }}</span></div>
    <div class="label-field c_middlename"><span class="auto-fit">{{ $child->middle_name }}</span></div>
    <div class="label-field c_lastname"><span class="auto-fit">{{ $child->last_name }}</span></div>
    <div class="label-field c_sex"><span class="auto-fit">{{ $child->gender }}</span></div>

    @if($birthDate)
        <div class="label-field c_dob_d"><span class="auto-fit">{{ $birthDate->format('d') }}</span></div>
        <div class="label-field c_dob_m"><span class="auto-fit">{{ $birthDate->format('F') }}</span></div>
        <div class="label-field c_dob_y"><span class="auto-fit">{{ $birthDate->format('Y') }}</span></div>
    @else
        <div class="label-field c_dob_d"><span class="auto-fit">N/A</span></div>
        <div class="label-field c_dob_m"><span class="auto-fit">N/A</span></div>
        <div class="label-field c_dob_y"><span class="auto-fit">N/A</span></div>
    @endif

    <div class="label-field c_pob_brgy"><span class="auto-fit">{{ optional($child->birthBarangay)->barangay_name ?? 'N/A' }}</span></div>
    <div class="label-field c_pob_city"><span class="auto-fit">{{ optional($child->birthCity)->municipality_name ?? 'N/A' }}</span></div>
    <div class="label-field c_pob_province"><span class="auto-fit">{{ optional($child->birthProvince)->province_name ?? 'N/A' }}</span></div>

    <div class="label-field c_typeofbirth"><span class="auto-fit">{{ optional($child->birthInfo)->type_of_birth ?? 'N/A' }}</span></div>
    <div class="label-field c_childwas"><span class="auto-fit">{{ optional($child->birthInfo)->child_was ?? 'N/A' }}</span></div>
    <div class="label-field c_birthOrder"><span class="auto-fit">{{ optional($child->birthInfo)->birth_order ?? 'N/A' }}</span></div>
    <div class="label-field c_weight"><span class="auto-fit">{{ optional($child->birthInfo)->weight_at_birth ?? 'N/A' }}</span></div>

    {{-- Mother's info --}}
    <div class="label-field m_totalbornalive"><span class="auto-fit">{{ optional($child->birthInfo)->total_number_of_children_alive ?? 'N/A' }}</span></div>
    <div class="label-field m_totalstillaliveinclude"><span class="auto-fit">{{ optional($child->birthInfo)->number_of_children_still_leaving ?? 'N/A' }}</span></div>
    <div class="label-field m_totalbornalivebutdead"><span class="auto-fit">{{ optional($child->birthInfo)->total_number_of_children_alive_dead ?? 'N/A' }}</span></div>
    <div class="label-field m_ageBorn"><span class="auto-fit">{{ optional($child->birthInfo)->age_of_mother ?? 'N/A' }}</span></div>

    <div class="label-field m_firstname"><span class="auto-fit">{{ $mother->first_name ?? 'N/A' }}</span></div>
    <div class="label-field m_middlename"><span class="auto-fit">{{ $mother->middle_name ?? 'N/A' }}</span></div>
    <div class="label-field m_lastname"><span class="auto-fit">{{ $mother->last_name ?? 'N/A' }}</span></div>
    <div class="label-field m_citizenship"><span class="auto-fit">{{ $mother->citizenship ?? 'N/A' }}</span></div>
    <div class="label-field m_religion"><span class="auto-fit">{{ $mother->religion ?? 'N/A' }}</span></div>
    <div class="label-field m_occupation"><span class="auto-fit">{{ $mother->occupation ?? 'N/A' }}</span></div>
    <div class="label-field m_res_brgy"><span class="auto-fit">{{ $mother_barangay ?? 'N/A' }}</span></div>
    <div class="label-field m_res_city"><span class="auto-fit">{{ $mother_city ?? 'N/A' }}</span></div>
    <div class="label-field m_res_province"><span class="auto-fit">{{ $mother_province ?? 'N/A' }}</span></div>
    <div class="label-field m_res_country"><span class="auto-fit">Philippines</span></div>

    {{-- Father's info --}}
    <div class="label-field f_firstname"><span class="auto-fit">{{ $father->first_name ?? 'N/A' }}</span></div>
    <div class="label-field f_middlename"><span class="auto-fit">{{ $father->middle_name ?? 'N/A' }}</span></div>
    <div class="label-field f_lastname"><span class="auto-fit">{{ $father->last_name ?? 'N/A' }}</span></div>
    <div class="label-field f_citizenship"><span class="auto-fit">{{ $father->citizenship ?? 'N/A' }}</span></div>
    <div class="label-field f_religion"><span class="auto-fit">{{ $father->religion ?? 'N/A' }}</span></div>
    <div class="label-field f_occupation"><span class="auto-fit">{{ $father->occupation ?? 'N/A' }}</span></div>
    <div class="label-field f_res_brgy"><span class="auto-fit">{{ $father_barangay ?? 'N/A' }}</span></div>
    <div class="label-field f_res_city"><span class="auto-fit">{{ $father_city ?? 'N/A' }}</span></div>
    <div class="label-field f_res_province"><span class="auto-fit">{{ $father_province ?? 'N/A' }}</span></div>
    <div class="label-field f_res_country"><span class="auto-fit">Philippines</span></div>
    <div class="label-field f_ageBorn"><span class="auto-fit">{{ optional($child->birthInfo)->age_of_father ?? 'N/A' }}</span></div>

    {{-- Marriage info --}}
    @if($marriageDate)
        <div class="label-field mop_date_m"><span class="auto-fit">{{ $marriageDate->format('F') }}</span></div>
        <div class="label-field mop_date_d"><span class="auto-fit">{{ $marriageDate->format('d') }}</span></div>
        <div class="label-field mop_date_y"><span class="auto-fit">{{ $marriageDate->format('Y') }}</span></div>
    @else
        <div class="label-field mop_date_m"><span class="auto-fit">N/A</span></div>
        <div class="label-field mop_date_d"><span class="auto-fit">N/A</span></div>
        <div class="label-field mop_date_y"><span class="auto-fit">N/A</span></div>
    @endif

    <div class="label-field mop_place_city"><span class="auto-fit">{{ $placeParts[0] ?? 'N/A' }}</span></div>
    <div class="label-field mop_place_province"><span class="auto-fit">{{ $placeParts[1] ?? 'Agusan del norte' }}</span></div>
    <div class="label-field mop_place_country"><span class="auto-fit">Philippines</span></div>

    {{-- Attendant info --}}
    <div class="label-field coaab_name"><span class="auto-fit">{{ optional($child->birthInfo->attendant)->name ?? 'N/A' }}</span></div>
    <div class="label-field coaab_position"><span class="auto-fit">{{ optional($child->birthInfo->attendant)->position ?? 'N/A' }}</span></div>
    <div class="label-field coaab_address"><span class="auto-fit">{{ optional($child->birthInfo->attendant)->address ?? 'N/A' }}</span></div>

    {{-- Current date/time --}}
    <div class="label-field coaab_date"><span class="auto-fit">{{ $formattedDate }}</span></div>
    <div class="label-field prepby_date"><span class="auto-fit">{{ $formattedDate }}</span></div>
    <div class="label-field coi_date"><span class="auto-fit">{{ $formattedDate }}</span></div>
    <div class="label-field coaab_time"><span class="auto-fit">{{ $formattedTime }}</span></div>

    {{-- Certificate of Identification --}}
    <div class="label-field coi_name"><span class="auto-fit">{{ $fatherFullName }}</span></div>
    <div class="label-field coi_relationship"><span class="auto-fit">Father</span></div>
    <div class="label-field coi_address_brgy">
        <span class="auto-fit">
            {{ optional($father->residenceBarangay)->barangay_name ?? 'N/A' }},
            {{ optional($father->residenceCity)->municipality_name ?? 'N/A' }}
        </span>
    </div>

    {{-- Prepared by --}}
    <div class="label-field prepby_name"><span class="auto-fit">Ghaizar A. Bautista</span></div>
    <div class="label-field prepby_title"><span class="auto-fit">Clerk</span></div>

    <script>
        // Auto-fit each text span to its box
        function autoFitText(selector) {
            const elements = document.querySelectorAll(selector);
            elements.forEach(el => {
                let fontSize = 14;
                while (el.scrollWidth > el.offsetWidth && fontSize > 6) {
                    fontSize -= 0.5;
                    el.style.fontSize = `${fontSize}px`;
                }
            });
        }
        
    </script>

    <script>
    window.onload = () => {
        autoFitText('.auto-fit'); 
        window.print();         
    };
</script>

</body>
</html>
