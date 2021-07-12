@extends('dashboard.layout.sideMenue')

@section('section')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Settings</h1>
    <div class="card shadow mb-4">
        <div class="card-body p-4">
            @if($errors->any())
            <div class="alert alert-danger" role="alert"> There is something wrong
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </div>
            @endif    
            <form method="POST" action="{{route('dashboard.settings.update')}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Instagram</label>
                  <input name="instagram" value="{{(old('instagram')?old('instagram'):$setting->instagram)}}" type="text" class="form-control" id="instagramHelp" aria-describedby="instagramHelp" placeholder="https://www.instagram.com/YourUserName/">
                  <small id="instagramHelp" class="form-text text-muted">add the full link</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Facebook</label>
                    <input type="text" value="{{(old('facebook'))?old('facebook'):$setting->facebook}}" name="facebook" class="form-control" id="facebookInput" aria-describedby="emailHelp" placeholder="https://www.facebook.com/YourUserName/">
                    <small id="facebookHelp" class="form-text text-muted">add the full link</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Chose your day's off</label>
                    <select name='daysOff[]' multiple class="form-control" id="exampleFormControlSelect2">
                      @foreach ($days as $day)
                          @if($day->isOff == 1)
                          <option selected value="{{$day->id}}">{{$day->name}}</option>
                          @else
                          <option value="{{$day->id}}">{{$day->name}}</option>
                          @endif
                      @endforeach
                    </select>
                    <small id="emailHelp" class="form-text text-muted">to chose more then one day press control on windows or command on mac os with the mouse click</small>
                </div>   
                <div class="col-md-12 text-right">
                    <button type='button' class="btn btn-danger">
                        <a style="color: #ffff" href="{{route('dashboard')}}">
                            Cancel
                        </a>
                    </button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>             
              </form>
        </div>
    </div>

@endsection