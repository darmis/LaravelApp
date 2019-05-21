@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-body">
                @if(isset($repair))
                {!! Form::open(['action' => ['RepairsController@update', $repair->id], 'method' => 'POST']) !!}
                {{Form::hidden('_method', 'PUT')}}
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                {!! Form::label('ID') !!}
                                {!! Form::text('id',$repair->id, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Barkodas') !!}
                                {!! Form::text('barkodas',$repair->barkodas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Tipas') !!}
                                {!! Form::text('tipas',$repair->tipas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Būsena') !!}
                                {!! Form::select('busena', ['uzregistruotas' => 'Užregistruotas', 'vykdomas' => 'Vykdomas', 'atliktas' => 'Atliktas'], $repair->busena, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Meistras') !!}
                                {!! Form::select('meistro_id', $userOptions, $repair->meistro_id, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Priregistruota') !!}
                                {!! Form::text('created_at',$repair->created_at, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Klientas') !!}
                                {!! Form::text('klientas',$repair->klientas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Mob. nr') !!}
                                {!! Form::text('mob_tel',$repair->mob_tel, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Tel. nr') !!}
                                {!! Form::text('tel',$repair->tel, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Spec. kompiuterio') !!}
                                {!! Form::textarea('spec_komp',$repair->spec_komp, ['class' => 'form-control', 'rows' => 4]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Gedimai') !!}
                                {!! Form::textarea('gedimai',$repair->gedimai, ['class' => 'form-control', 'rows' => 4]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Pastabos') !!}
                                {!! Form::textarea('pastabos',$repair->pastabos, ['class' => 'form-control', 'rows' => 4]) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Bendra kaina') !!}
                                {!! Form::text('bendra_kaina',$repair->remonto_kainal + $repair->daliu_kaina, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Dalių kaina') !!}
                                {!! Form::text('daliu_kaina',$repair->daliu_kaina, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Remonto kaina') !!}
                                {!! Form::text('remonto_kaina',$repair->remonto_kaina, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Ar rodo?') !!}
                                {!! Form::select('arRodo', [true => 'Taip', false => 'Ne'], $repair->arRodo, ['class' => 'form-control']) !!}
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