@extends('dashboard.layout.nav2')
@section('content')

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-4 text-gray-800">Appointment</h1> --}}
    {{-- <p class="mb-4">You have 50 appointment</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Appointment</h3>
                    <p class="text-subtitle text-muted">Appointment Section </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-4 float-end">
                        {{-- <h6>Right Icon</h6> --}}
                            <div class="form-group position-relative has-icon-right">
                                <input id="search_input" name='search_input' type="text" class="form-control"
                                    placeholder="Search throw the client name or phone number">
                                <div class="form-control-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                            <button onclick="search()" class="btn btn-primary">Search</button>
                       
                    </div>
                    <div class="col-sm-5 float-start">
                        <h6>Filter</h6>
                        <span>Select the range of days you want to see the appoinments from</span>
                        <div class="dropdown icon-right">
                            <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButtonIconRight" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if($filter == 1)
                                Today <i class="bi bi-error-circle ml-50"></i>
                                @endif
                                @if($filter == 2)
                                This Week <i class="bi bi-error-circle ml-50"></i>
                                @endif
                                @if($filter == 3)
                                This Month
                                @endif
                                @if($filter == 'null')
                                All <i class="bi bi-error-circle ml-50"></i>
                                @endif
                                
                                @if(!$filter)
                                All <i class="bi bi-error-circle ml-50"></i>
                                @endif

                                @if($filter&&$filter != 'null'&&$filter != 1&&$filter != 2&&$filter != 3)
                                Search Results <i class="bi bi-error-circle ml-50"></i>
                                @endif

                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonIconRight">
                                @if($filter == 'null')
                                <a style="background-color: #435ebe; color:#fff;" onclick="filterData()" class="dropdown-item justify-content-between" href="#">All</a>
                                @else
                                <a onclick="filterData()" class="dropdown-item justify-content-between" href="#">All</a>
                                @endif
                                
                                @if($filter == 1)
                                <a style="background-color: #435ebe; color:#fff;" onclick="filterData(1)" class="dropdown-item justify-content-between" href="#">Today</a>

                                @else
                                <a onclick="filterData(1)" class="dropdown-item justify-content-between" href="#">Today</a>
                                                                @endif
                                @if($filter == 2)
                                <a style="background-color: #435ebe; color:#fff;" onclick="filterData(2)" class="dropdown-item justify-content-between" href="#">This Week</a>
                                @else
                                <a onclick="filterData(2)" class="dropdown-item justify-content-between" href="#">This Week</a>
                                @endif
                                @if($filter == 3)
                                <a style="background-color: #435ebe; color:#fff;" onclick="filterData(3)" class="dropdown-item justify-content-between" href="#">This Month</a>
                                @else
                                <a onclick="filterData(3)" class="dropdown-item justify-content-between" href="#">This Month</a>
                                @endif

                            </div>
                        </div>                 
                    </div>
                </div>
                <div class="card-body">
                    @if (count($appointments) > 0)
                        <div class="row" id="table-bordered">
                                        
                                        <!-- table bordered -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-5">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>#</th> --}}
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Phone</th>
                                                        <th>Ip</th>
                                                        <th>Note</th>
                                                        <th>Price</th>
                                                        <th>Was Made</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($appointments as $ap)
                                                        <tr>
                                                            <td class="text-bold-500"><a href="https://www.instagram.com/{{$ap->instagram}}" target="_blank">{{$ap->name}}</a></td>
                                                            <td><i style="font-size:12px;" class="bi bi-calendar-fill"></i> {{date("D", strtotime($ap->time))}} {{date('d-m-Y', strtotime($ap->time))}}</td>
                                                            <td class="text-bold-500">{{$ap->phone}}</td>
                                                            <td>{{$ap->ip}}</td>
                                                            <td style="max-width: 200px; padding:1%;">{{$ap->note}}</td>
                                                            <td>
                                                            @if($ap->price)
                                                            ${{$ap->price}}
                                                            @else
                                                            No Price
                                                            @endif
                                                            </td>
                                                            <td>{{$ap->created_at->diffForHumans()}}</td>
                                                            <td>
                                                                @if($ap->status == 1)
                                                                <a style="font-size:10px; padding:2px; background:green; color:#fff; border-radius:2px;" href="#" >Conform</a>
                                                                @endif
                                                                @if($ap->status == 0&&$ap->status != null)
                                                                <a style="font-size:10px; padding:2px; background:red; color:#fff; border-radius:2px;" href="#" >Denyed</a>
                                                                @endif
                                                                @if($ap->status == null)
                                                                <a style="font-size:10px; padding:2px; background:orange; color:#fff; border-radius:2px;" href="#" >Pending</a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('dashboard.appointment.edit',$ap->id)}}" class="btn btn-info btn-circle btn-sm">
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                </a>
                                                                <a href="{{route('dashboard.appointment.delete',$ap->id)}}" class="btn btn-danger btn-circle btn-sm">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                
                                            </table>
                                            {{$appointments->links('pagination::bootstrap-4')}}

                                        </div>
                                    

                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        
                            <p class="text-center" style="font-size:15px;">
                                <i class="bi bi-calendar-fill"></i><br/>
                                No appointment avalible
                            </p>    
                    @endif
                   
                </div>
            </div>

        </section>
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

        function filterData(value = null)
        {
            var select = document.getElementById('filterData');
			// var option = select.options[select.selectedIndex];
            var url = '{{ route("dashboard.appointment.index", ":id") }}';
                url = url.replace(':id', value);

            window.location.href = url;
        }
        function search()
        {
            let search_value = document.getElementById('search_input').value;
            let sending_request = '{{ route("dashboard.appointment.index",":id") }}';
            sending_request = sending_request.replace(':id',search_value);
            window.location.href = sending_request;
        }
      </script>
      

@endsection