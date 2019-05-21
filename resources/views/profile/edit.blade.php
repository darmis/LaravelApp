@extends('layouts.app')

@section('content')
    @if (session('info'))
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('info') }}
                </div>
            </div>
        </div>        
    @elseif (session('error'))
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Keisti profilio duomenis</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('profile.update', ['user' => $user]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Vardas</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-12 control-label">Pavardė</label>
                            <div class="col-md-12">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">El. paštas</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current-password" class="col-md-12 control-label">Dabartinis slaptažodis</label>

                            <div class="col-md-12">
                                <input id="current-password" type="password" class="form-control" name="current_password">

                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Naujas slaptažodis</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 control-label">Pakartoti naują slaptažodį</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Keisti
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection