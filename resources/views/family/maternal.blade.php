@extends($layout)
@section('header')
Maternal Management
@endsection
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Maternal List</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-head-fixed text-nowrap " id="maternalTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Full Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mothers as $index => $mother)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ ucwords($mother->full_name) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<script>
    $(function () {
        $('#maternalTable').DataTable({
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