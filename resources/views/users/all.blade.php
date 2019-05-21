@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-header text-center text-uppercase"><h4>{{$name}}</h4></div>

            <div class="card-body">
                <h3> 
                    @if($role <= 1)
                        <span class="float-left py-2"><a href="/users/create" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createUserModal">Sukurti naują vartotoją</a></span>
                    @endif
                </h3>
                @if(count($users))
                    <table class="table table-sm table-hover table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Rolė</th>
                            @if($role <= 1)
                                <th>Sukurtas</th>
                                <th>Taisytas</th>
                            @endif
                            <th>Veiksmai</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td><a href="/users/{{$user->id}}">{{$user->id}}</a></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->lastname}}</td>
                            <td>
                                @switch($user->role_id)
                                    @case(0)
                                        <span>CO-Owner</span>
                                        @break

                                    @case(1)
                                        <span>Admin</span>
                                        @break

                                    @default
                                        <span>User</span>
                                @endswitch
                            </td>
                            @if($role <= 1)
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                            @endif
                            <td>
                                <div class="row">
                                    <span><a href="/users/{{$user->id}}" class="btn btn-primary btn-sm center"><i class="fa fa-search"></i></a></span>
                                @if($role <= 1)
                                    <span><a href="/users/{{$user->id}}/edit" class="btn btn-success btn-sm center"><i class="fa fa-edit"></i></a></span>
                                    <span>
                                        {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => 'center', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
                                        {!! Form::close() !!}
                                    </span>
                                @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{$users->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal CREATE-->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createUserModalLabel">Sukurti naują vartotoją</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label("Vardas", null, ['class' => 'control-label'])}}
                    {{Form::text("name", '', array_merge(['class' => 'form-control'], ['palceholder' => 'Vardas']))}}
                </div>
                <div class="form-group">
                    {{Form::label("Pavardė", null, ['class' => 'control-label'])}}
                    {{Form::text("lastname", '', array_merge(['class' => 'form-control'], ['palceholder' => 'Pavardė']))}}
                </div>
                <div class="form-group">
                    {{Form::label("El. paštas", null, ['class' => 'control-label'])}}
                    {{Form::text("email", '', array_merge(['class' => 'form-control'], ['palceholder' => 'El. paštas']))}}
                </div>
                <div class="form-group">
                    <label for="role_id" class="control-label">Rolė</label>
                    <select class="form-control" name="role_id">
                        <option value="0">Co-owner</option>
                        <option value="1">Administrator</option>
                        <option value="2" selected>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Slaptažodis</label>
                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Pakartoti slaptažodį</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>
                <div>
                    {{Form::submit('Sukurti vartotoją', ['class' => 'btn btn-primary'])}}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
        </div>
        </div>
    </div>
</div>

@endsection