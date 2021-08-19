@extends('dashboard.layout.sideMenue')
@section('section')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Appointment</h1>
    {{-- <p class="mb-4">You have 50 appointment</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
            <div class="form-group">
                <label for="filterData">Select the range of days you want to see the appoinments from</label>
                <select onChange="filterData()" class="form-control" id="filterData">
                    <option>All</option>
                  <option {{ ($filter == 1)?'selected':'' }} value='1'>Today</option>
                  <option {{ ($filter == 2)?'selected':'' }} value='2'>This Week</option>
                  <option {{ ($filter == 3)?'selected':'' }} value ='3' >This Month</option>
                </select>
              </div>
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
                        <th>Was Made </th>
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
              ajax: "{{ route('dashboard.appointment.datatable',$filter) }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'time', name: 'time'},
                  {data: 'phone', name: 'phone'},
                  {data: 'ip', name: 'ip'},
                  {data: 'note', name: 'note'},
                  {data: 'price', name: 'price'},
                  {data: 'created_at', name: 'created_at'},
                  {data: 'status', name: 'status'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
          
        });

        function filterData(value)
        {
            var select = document.getElementById('filterData');
			var option = select.options[select.selectedIndex];
            var url = '{{ route("dashboard.appointment.index", ":id") }}';
                url = url.replace(':id', option.value);

            window.location.href = url;
        }
      </script>
      

@endsection