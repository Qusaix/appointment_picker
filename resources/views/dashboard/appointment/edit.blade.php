@extends('dashboard.layout.sideMenue')
@section('section')
<h1 class="h3 mb-4 text-gray-800">Edit</h1>
<div class="card shadow mb-4 p-5">
    @if($errors->any())
    <div class="alert alert-danger" role="alert"> There is something wrong
        @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
    </div>
    @endif

    <div class="alert alert-primary" role="alert">
        <div class="text-center">
            <h3>
                Info
            </h3>
        </div>
        <ul class="list-group">
            <li class="list-group-item">Name: {{$appointment->name}}</li>
            <li class="list-group-item">Phone: {{$appointment->phone}}</li>
            <li class="list-group-item">Instagram: <a href="https://www.instagram.com/{{$appointment->instagram}}" target="_blank">{{$appointment->instagram}}</a></li>
            <li class="list-group-item">Date: {{date('D', strtotime($appointment->time)).' '.date("d/m/Y", strtotime(str_replace('-"', '/', $appointment->time)))}}</li>
            <li class="list-group-item">Note: {{$appointment->note}}</li>
          </ul>
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
                <button type="button" class="btn btn-danger">
                    <a href="{{route('dashboard.appointment.index')}}" style="color: #ffff;decoration:none;" href="">
                        Cancel
                    </a>
                </button>
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </form>
</div>

@endsection