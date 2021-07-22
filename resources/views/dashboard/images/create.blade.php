@extends('dashboard.layout.sideMenue')

@section('section')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Image</h1>
    <div class="card shadow mb-4">
        <div class="card-body p-4">
            @if($errors->any())
            <div class="alert alert-danger" role="alert"> There is something wrong
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </div>
            @endif    
            <form method="POST" action="{{route('dashboard.images.store')}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Image Link</label>
                  <input name="link" value="{{(old('image')?old('image'):'')}}" type="text" class="form-control" id="image" aria-describedby="image" placeholder="https://www.imgbb.com/YourImageLink.png">
                  <small id="instagramHelp" class="form-text text-muted">upload images from www.imgbb.com and add the link above</small>
                </div>
                <div class="col-md-12 text-right">
                    <button type='button' class="btn btn-danger">
                        <a style="color: #ffff" href="{{route('dashboard.images.index')}}">
                            Cancel
                        </a>
                    </button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>             
              </form>
        </div>
    </div>

@endsection