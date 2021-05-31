@extends('layout')

@section('content')
<div class="container box-wapper">
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
    </div>
    @endif
    <form class="mt-3" method="POST" action="{{route('user.review')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Url</label>
            <input type="text" name="url" value="{{! empty($oldUser['url']) ? $oldUser['url'] : old('url')}}"
                class="form-control" placeholder="Enter url">
            @error('url')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{! empty($oldUser['name']) ? $oldUser['name'] : old('name')}}"
                class="form-control" placeholder="Enter name">
            @error('name')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" value="{{! empty($oldUser['email']) ? $oldUser['email'] : old('email')}}"
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
                value="{{! empty($oldUser['password']) ? $oldUser['password'] : old('password')}}" class="form-control"
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
                value="{{! empty($oldUser['password_confirmation']) ? $oldUser['password_confirmation'] : old('password_confirmation')}}"
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
                value="{{! empty($oldUser['start_date']) ? $oldUser['start_date'] : old('start_date')}}"
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
                value="{{! empty($oldUser['end_date']) ? $oldUser['end_date'] : old('end_date')}}" class="form-control"
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
                <option {{! empty($oldUser['select_box']) && $oldUser['select_box'] == 1 ? 'selected' : ''}} value="1">
                    Select 1</option>
                <option {{! empty($oldUser['select_box']) && $oldUser['select_box'] == 2 ? 'selected' : ''}} value="2">
                    Select 2</option>
                <option {{! empty($oldUser['select_box']) && $oldUser['select_box'] == 3 ? 'selected' : ''}} value="3">
                    Select 3</option>
            </select>
            @error('select_box')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <input type="checkbox" name="checked"
                {{! empty($oldUser['checked']) && $oldUser['checked'] == 'on' ? 'checked' : ''}}>
            <label>Check me</label>
            @error('checked')
            <div>
                <small class="text-danger">{{$message}}</small>
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Review</button>

    </form>
</div>
@endsection
