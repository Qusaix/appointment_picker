@extends('dashboard.layout.nav2')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">
<h1 class="h3 mb-4 text-gray-800">Edit {{$appointment->name}} Appointment</h1>
<div class="card shadow mb-4 p-5">
    @if($errors->any())
    <div class="alert alert-danger" role="alert"> There is something wrong
        @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
    </div>
    @endif
    <div class="alert alert-primary" role="alert">
        <i class="bi bi-file-earmark-person-fill"></i> {{$appointment->name}} <br/>
        <i class="bi bi-phone-fill"></i> {{$appointment->phone}}<br/>
        <i class="bi bi-instagram"></i> <a href="https://www.instagram.com/{{$appointment->instagram}}" target="_blank">{{$appointment->instagram}}</a><br/>
        <i class="bi bi-calendar-range-fill"></i> {{date('D', strtotime($appointment->time)).' '.date("d/m/Y", strtotime(str_replace('-"', '/', $appointment->time)))}}<br/>
        <i class="bi bi-chat-square-text-fill"></i> Details:<br/>
        <p style="font-family: 'Cairo', sans-serif;">
            {{$appointment->note}}
        </p>

    </div>
        <form method="POST" action="{{route('dashboard.appointment.update',$appointment->id)}}">
            @csrf
            <div class="form-group">
            <label for="exampleFormControlInput1">Price</label>
            <input value="{{ (old('price'))?old('price'):$appointment->price}}" min='0' name="price" type="number" class="form-control" id="exampleFormControlInput1" placeholder="10.00">
            </div>
            <div class="form-group">
            <label for="exampleFormControlSelect1">Appointment</label>
            <select name='status' class="form-control" id="exampleFormControlSelect1">
                <option {{($appointment->status == 1)?'selected':old('status')}} value="1">Conform</option>
                <option {{($appointment->status == 0)?'selected':old('status')}} value="0" >Deny</option>
            </select>
            </div>
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-secondary">
                    <a href="{{route('dashboard.appointment.index')}}" style="color: #ffff;decoration:none;" href="">
                        Cancel
                    </a>
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
</div>

@endsection