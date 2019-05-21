@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-header text-center text-uppercase"><h4>Edit {{$name}} User</h4></div>

            <div class="card-body">
                {!! Form::open(['action' => ['UsersController@update', $users->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'PUT')}}
                    <div class="form-group">
                        {{Form::label("name", null, ['class' => 'control-label'])}}
                        {{Form::text("name", $users->name, array_merge(['class' => 'form-control'], ['palceholder' => 'User name']))}}
                    </div>
                    <div class="form-group">
                        {{Form::label("lastname", null, ['class' => 'control-label'])}}
                        {{Form::text("lastname", $users->lastname, array_merge(['class' => 'form-control'], ['palceholder' => 'User last name']))}}
                    </div>
                    <div class="form-group">
                        {{Form::label("email", null, ['class' => 'control-label'])}}
                        {{Form::text("email", $users->email, array_merge(['class' => 'form-control'], ['palceholder' => 'User email']))}}
                    </div>
                    <div class="form-group">
                        <label for="role" class="control-label">Role</label>
                        <select class="form-control" name="role">
                            <option value="0" {{ $users->role == 0 ? 'selected' : ''}}>Co-owner</option>
                            <option value="1" {{ $users->role == 1 ? 'selected' : ''}}>Administrator</option>
                            <option value="2" {{ $users->role == 2 ? 'selected' : ''}}>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label">Password Confirmation</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                    {{Form::submit('Edit User', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection