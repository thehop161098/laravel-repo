@extends('layout')

@section('content')
<div class="container box-wapper">
    <form class="mt-3" method="POST" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Url</label>
            <input type="text" name="url" value="{{$user->url}}"
                class="form-control" placeholder="Enter url">
            @error('url')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{$user->name}}"
                class="form-control" placeholder="Enter name">
            @error('name')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" value="{{$user->email}}"
                class="form-control" placeholder="Enter email">
            @error('email')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password"
                value="" class="form-control"
                placeholder="Enter password">
            @error('password')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password Confirmation</label>
            <input type="text" name="password_confirmation"
                value=""
                class="form-control" placeholder="Enter re-password">
            @error('password_confirmation')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date"
                value="{{$user->start_date}}"
                class="form-control" placeholder="Enter start date">
            @error('start_date')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date"
                value="{{$user->end_date}}" class="form-control"
                placeholder="Enter end date">
            @error('end_date')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" placeholder="select image">
            <div>
                <img style="max-width: 100%" class="img-responsive" src="{{asset('storage/images/user/'.$user->image)}}"
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
            <select class="form-control" name="select_box">
                <option value="">-- Select Box --</option>
                <option {{! empty($user['select_box']) && $user['select_box'] == 1 ? 'selected' : ''}} value="1">
                    Select 1</option>
                <option {{! empty($user['select_box']) && $user['select_box'] == 2 ? 'selected' : ''}} value="2">
                    Select 2</option>
                <option {{! empty($user['select_box']) && $user['select_box'] == 3 ? 'selected' : ''}} value="3">
                    Select 3</option>
            </select>
            @error('select_box')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Update</button>

    </form>
</div>
@endsection
