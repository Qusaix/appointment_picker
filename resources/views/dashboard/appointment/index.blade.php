@extends('dashboard.layout.sideMenue')
@section('section')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Appointment</h1>
    {{-- <p class="mb-4">You have 50 appointment</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div> --}}
        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Phone</th>
                        <th>Ip</th>
                        <th>Note</th>
                        <th>Price</th>
                        <th>status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
          
          var table = $('.table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('dashboard.appointment.datatable') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'time', name: 'time'},
                  {data: 'phone', name: 'phone'},
                  {data: 'ip', name: 'ip'},
                  {data: 'note', name: 'note'},
                  {data: 'price', name: 'price'},
                  {data: 'status', name: 'status'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
        });
      </script>
      

@endsection