@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-header text-center text-uppercase"><h4>{{$name}}</h4></div>

            <div class="card-body">
                @if(isset($usr))
                    <table class="table table-sm table-hover table-striped">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role</th>
                            @if($role <= 1)
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            @endif
                        </tr>
                        <tr>
                            <td>{{$usr->id}}</td>
                            <td>{{$usr->name}}</td>
                            <td>{{$usr->lastname}}</td>
                            <td>
                                @switch($usr->role)
                                    @case(0)
                                        <span>Owner</span>
                                        @break

                                    @case(1)
                                        <span>Admin</span>
                                        @break

                                    @default
                                        <span>User</span>
                                @endswitch
                            </td>
                            @if($role <= 1)
                                <td>{{$usr->created_at}}</td>
                                <td>{{$usr->updated_at}}</td>
                                <td>
                                    <div class="row">
                                    @if($role <= 1)
                                        <span><a href="/users/{{$usr->id}}/edit" class="btn btn-success btn-sm center"><i class="fa fa-edit"></i></a></span>
                                        <span>
                                            {!! Form::open(['action' => ['UsersController@destroy', $usr->id], 'method' => 'POST', 'class' => 'center', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
                                            {!! Form::close() !!}
                                        </span>
                                    @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection