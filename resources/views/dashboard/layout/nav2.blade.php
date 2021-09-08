<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Salem Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets1/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets1/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets1/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets1/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets1/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.svg')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>

<body>

    <div id="app">
        @extends('dashboard.layout.sideMenue2')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                {{-- <h3>Appointments Statistics</h3> --}}
            </div>
           @yield('content')


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Salem sulibe</p>
                    </div>
                    {{-- <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div> --}}
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('assets1/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets1/js/bootstrap.bundle.min.js')}}"></script>

    {{-- <script src="{{asset('assets1/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets1/js/pages/dashboard.js')}}"></script> --}}
    @if(isset($monthlySales))
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
    @endif
    
    @include('sweetalert::alert')
    <script src="{{asset('assets1/js/main.js')}}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
              $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    </script>
</body>

</html>