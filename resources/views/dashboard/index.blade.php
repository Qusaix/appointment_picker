@extends('dashboard.layout.nav2')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">This Month</h6>
                                    <h6 class="font-extrabold mb-0">${{$currentMonthEarnings}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">This year</h6>
                                    <h6 class="font-extrabold mb-0">${{$annualEarnings}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">New Ap</h6>
                                    <h6 class="font-extrabold mb-0">{{$today->count()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pending Ap</h6>
                                    <h6 class="font-extrabold mb-0">{{$pendingRequest}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-12 col-xl-6">
                    {{-- <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-primary" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="{{asset('assets1/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill')}}" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">Europe</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-0">862</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-europe"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-success" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="{{asset('assets1/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill')}}" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">America</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-0">375</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-america"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-danger" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="{{asset('assets1/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill')}}" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">Indonesia</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-0">1025</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-indonesia"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>Today's Appoinments</h4>
                            <h6 class="text-muted mb-0">Revenue: ${{$todaAppointmentsEaring}}</h6>
                        </div>
                       
                        <div class="card-body">
                            @if(count($todaAppointments) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Note</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($todaAppointments as $ap)
                                                <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                {{-- <img src="{{asset('assets1/images/faces/5.jpg')}}"> --}}
                                                                <p>
                                                                    {{$ap->name}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{$ap->phone}}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{$ap->note}}</p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            ${{$ap->price}}
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        {{-- <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{asset('assets1/images/faces/2.jpg')}}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Wow amazing design! Can you make another
                                                    tutorial for
                                                    this design?</p>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h6 class="text-muted mb-0">You have 0 appoinments today</h6>
                            @endif
                           
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">

                    <div class="card">
                        <div class="card-header">
                            <h4>Tomorrow's Appoinments</h4>
                            <h6 class="text-muted mb-0">Revenue: ${{$tomorrowAppointmentsEaring}}</h6>
                        </div>
                        <div class="card-body">
                            @if(count($tomorrow) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Note</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($tomorrow as $ap)
                                                <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                {{-- <img src="{{asset('assets1/images/faces/5.jpg')}}"> --}}
                                                                <p>
                                                                    {{$ap->name}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{$ap->phone}}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{$ap->note}}</p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            ${{$ap->price}}
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h6 class="text-muted mb-0">You have 0 appoinments tomorrow</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{asset('assets1/images/faces/2.jpg')}}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            {{-- <h5 class="font-bold">Welcome Admin</h5> --}}
                            <h6 class="text-muted mb-0">You have {{$countAllAppointments}} appoinments on the website</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Was added today</h4>
                    <h6 class="text-muted mb-0">You have {{$today->count()}} new appoinments</h6>
                </div>
                <div class="card-content pb-4">
                    @foreach ($today as $ap)
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="{{asset('assets1/images/faces/5.jpg')}}">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1"> <a href="">{{$ap->name}}</a></h5>
                                <h6 class="text-muted mb-0"><a href="{{route('dashboard.appointment.edit',$ap->id)}}">Show</a></h6>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Go to appoinments</button>
                    </div> --}}
                </div>
            </div>
            
            {{-- <div class="card">
                <div class="card-header">
                    <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div> --}}
        </div>
        
        <script src="{{asset('assets1/vendors/apexcharts/apexcharts.js')}}"></script>
        {{-- <script src="{{asset('assets1/js/pages/dashboard.js')}}"></script> --}}
        <script src="{{asset('assets1/js/main.js')}}"></script>

        <script>
            var optionsProfileVisit = {
                annotations: {
                    position: 'back'
                },
                dataLabels: {
                    enabled:true
                },
                chart: {
                    type: 'bar',
                    height: 300
                },
                fill: {
                    opacity:1
                },
                plotOptions: {
                },
                series: [{
                    name: 'Earrings',
                    data: {!! json_encode($monthlySales) !!}
                }],
                colors: '#435ebe',
                xaxis: {
                    categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
                },
            }
            var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
            chartProfileVisit.render();
    
        </script>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection