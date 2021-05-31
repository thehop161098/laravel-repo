@extends('layout')

@section('content')
<div class="container box-wapper">
    <div class="mb-3">
        <label>Url</label>
        <p>{{$data['url']}}</p>
    </div>

    <div class="mb-3">
        <label>Name</label>
        <p>{{$data['name']}}</p>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <p>{{$data['email']}}</p>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <p>{{$data['password']}}</p>
    </div>

    <div class="mb-3">
        <label>Password Confirmation</label>
        <p>{{$data['password_confirmation']}}</p>
    </div>

    <div class="mb-3">
        <label>Start Date</label>
        <p>{{$data['start_date']}}</p>
    </div>

    <div class="mb-3">
        <label>End Date</label>
        <p>{{$data['end_date']}}</p>
    </div>

    <div class="mb-3">
        <label>Image</label>
        {{-- <input type="hidden" name="image" value="{{$data['image']}}" class="form-control" placeholder="select
        image"> --}}
        <div>
            <img style="max-width: 100%" class="img-responsive" src="{{asset('storage/images/user/'.$data['image'])}}"
                alt="img">
        </div>
        @error('image')
        <div>
            <small class="text-danger">{{$message}}</small>
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Select Box</label>
        @if($data['select_box'] == 1)
        <p>Select 1</p>
        @elseif($data['select_box'] == 2)
        <p>Select 2</p>
        @else
        <p>Select 3</p>
        @endif
    </div>

    <div class="mb-3">
        <input type="checkbox" {{$data['checked'] == 'on' ? 'checked' : ''}} name="checked">
        <label>Check me</label>
        @error('checked')
        <div>
            <small class="text-danger">{{$message}}</small>
        </div>
        @enderror
    </div>

    <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
        @csrf
        <a href="{{route('user.create')}}" class="btn btn-primary mb-3">Back</a>
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
    </form>

</div>
@endsection
