@extends('layouts.master')

@section('content')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let password = prompt("Enter password to terminate the system:");

    if (!password) {
        location.href = "{{ url('/dashboard/developer') }}";
        return;
    }

    fetch("{{ url('/terminate-action') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ password })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.href = "{{ url('/dashboard/developer') }}";
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Unexpected error occurred.");
        location.href = "{{ url('/dashboard/developer') }}";
    });
});
</script>

@endsection
