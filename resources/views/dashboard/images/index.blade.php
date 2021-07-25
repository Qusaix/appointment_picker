@extends('dashboard.layout.sideMenue')
@section('section')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Images</h1>
    {{-- <p class="mb-4">You have 50 appointment</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div> --}}
        <div class="card-body">
            <div class="text-right mb-5">
                <a href="{{route('dashboard.images.create')}}" type="button" class="btn btn-primary"> Add</a>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Created</th>
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
              ajax: "{{ route('dashboard.images.datatable') }}",
              columns: [
                  {data: 'link', name: 'link'},
                  {data:'created_at',name:'created_at'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
        });
      </script>
      

@endsection