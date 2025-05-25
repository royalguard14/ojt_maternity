@extends($layout)
@section('header')
Offsprint Management
@endsection
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Offspring Records</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover" id="offspringTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Full Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($children as $index => $child)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ ucwords($child->full_name) }}</td>
              
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<script>
    $(function () {
        $('#offspringTable').DataTable({
            "pageLength": 5,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection