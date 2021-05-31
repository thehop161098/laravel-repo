@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary btn-sm" href="{{route('user.create')}}" role="button"><i class="fa fa-plus"></i>&nbsp; Add</a>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Select Box</th>
                                        <th>Tool</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    @php
                                        if($user->select_box == 1) {
                                            $textBox = 'Select 1';
                                        }
                                        elseif($user->select_box == 2) {
                                            $textBox = 'Select 2';
                                        }
                                        else {
                                            $textBox = 'Select 3';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->start_date}}</td>
                                        <td>{{$user->end_date}}</td>
                                        <td>{{$textBox}}</td>
                                        <td>
                                            <a href="{{route('user.show', $user->id)}}" class="btn btn-sm btn-info">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-form-{{$user->id}}').submit();"
                                            >
                                                Delete
                                            </a>
                                        </td>
                                        <form id="delete-form-{{$user->id}}" action="{{route('user.delete', $user->id)}}"
                                            method="post">
                                            @csrf @method('DELETE')
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
@endsection
