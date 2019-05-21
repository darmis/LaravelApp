@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-body">
                @if(isset($service))
                {!! Form::open(['action' => ['ServiceController@update', $service->id], 'method' => 'POST']) !!}
                {{Form::hidden('_method', 'PUT')}}
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                {!! Form::label('ID') !!}
                                {!! Form::text('id',$service->id, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Klientas') !!}
                                {!! Form::text('klientas',$service->klientas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Telefonas') !!}
                                {!! Form::text('tel',$service->tel, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Darbo laikas') !!}
                                {!! Form::text('darbo_laikas',$service->darbo_laikas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                {!! Form::label('Adresas') !!}
                                {!! Form::text('adresas',$service->adresas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Atstumas') !!}
                                {!! Form::text('atstumas',$service->atstumas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Užduotis') !!}
                                {!! Form::textarea('uzduotis',$service->uzduotis, ['class' => 'form-control', 'rows' => 4]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Atlikti darbai') !!}
                                {!! Form::textarea('atlikta',$service->atlikta, ['class' => 'form-control', 'rows' => 4]) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Dirbta valandų') !!}
                                {!! Form::text('dirbta_val',$service->dirbta_val, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{Form::label('Meistras', null, ['class' => 'control-label'])}}
                                {{Form::select('meistro_id', $userOptions, $service->meistro_id, ['class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Būsena') !!}
                                {!! Form::select('busena', ['uzregistruotas' => 'Užregistruotas', 'vykdomas' => 'Vykdomas', 'atliktas' => 'Atliktas'], $service->busena, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Ar rodo?') !!}
                                {!! Form::select('arRodo', [true => 'Taip', false => 'Ne'], $service->arRodo, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                {{Form::submit('Išsaugoti', ['class' => 'btn btn-primary float-right'])}}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection