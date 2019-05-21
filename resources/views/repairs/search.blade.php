@extends('layouts.app')
<link href='{{ asset('packages/datepicker/datepicker.min.css') }}' rel='stylesheet' />
<script src='{{ asset('packages/datepicker/datepicker.min.js') }}'></script>
@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-header text-center text-uppercase"><h4>{{$name}}</h4></div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div> 
                    @if($role <= 1)
                    <div class="float-left py-2"><a href="/repairs/create" class="btn btn-success" data-toggle="modal" data-target="#createRepairModal">Pridėti naują</a></div>
                    @endif
                </div>
                
                @if(count($repairs))
                    <table class="table table-sm table-hover table-striped">
                        <tr>
                            <th>Rodo</th>
                            <th>Veiksmai</th>
                            <th>ID/Barkodas</th>
                            <th>Būsena/Tipas</th>
                            <th>Klientas</th>
                            <th>Meistras</th>
                            <th>Spec. kompiuterio</th>
                            <th>Gedimai</th>
                            <th>Pastabos</th>
                            <th>Dalių/Remonto<br>Bendra kaina</th>
                            <th>Priregistruota/<br>Registratorius</th>
                        </tr>
                        @foreach($repairs as $repair)
                            <tr>
                                <td><input class="isShowingRepair" data-showing-id={{$repair->id}} type="checkbox" name="arRodo" {{$repair->arRodo ? 'checked' : ''}}></td>
                                <td>
                                    <div class="row">
                                        <span><a href="/repairs/{{$repair->id}}" class="btn btn-primary btn-sm center"><i class="fa fa-search"></i></a></span>
                                        <span><a href="/repairs/{{$repair->id}}/print" target="_blank" class="btn btn-secondary btn-sm center"><i class="fa fa-print"></i></a></span>
                                    @if($role <= 1)
                                        <span><a href="/repairs/{{$repair->id}}/edit" class="btn btn-success btn-sm center"><i class="fa fa-edit"></i></a></span>
                                        <span>
                                            {!! Form::open(['action' => ['RepairsController@destroy', $repair->id], 'method' => 'POST', 'class' => 'center', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
                                            {!! Form::close() !!}
                                        </span>
                                    @endif
                                    </div>
                                </td>
                                <td>{{$repair->id}}<br>{{$repair->barkodas}}</td>
                                <td>{{$repair->busena}}<br>{{$repair->tipas}}</td>
                                <td>{{$repair->klientas}}</td>
                                <td>{{$userOptions[$repair->meistro_id]}}</td>
                                <td>{{$repair->spec_komp}}</td>
                                <td>{{$repair->gedimai}}</td>
                                <td>{{$repair->pastabos}}</td>
                                <td>{{$repair->daliu_kaina}}/{{$repair->remonto_kaina}}<br><span style="color: blue;">{{$repair->daliu_kaina + $repair->remonto_kaina}}</span></td>
                                <td>{{$repair->created_at}}<br>{{$userOptions[$repair->registrator_id]}}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{$repairs->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal CREATE-->
<div class="modal fade" id="createRepairModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Naujas įrašas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['action' => 'RepairsController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('Klientas') !!}
                    {!! Form::text('klientas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{Form::label('Meistras', null, ['class' => 'control-label'])}}
                    {{Form::select('meistro_id', $userOptions, null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('Barkodas') !!}
                    {!! Form::text('barkodas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Mob. Nr') !!}
                    {!! Form::text('mob_tel',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Telefonas') !!}
                    {!! Form::text('tel',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{Form::label('Būsena', null, ['class' => 'control-label'])}}
                    {{Form::select('busena', ['uzregistruotas' => 'Užregistruotas', 'vykdomas' => 'Vykdomas', 'atliktas' => 'Atliktas'], null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{Form::label('Tipas', null, ['class' => 'control-label'])}}
                    {{Form::select('tipas', ['Neaišku ar garantinis' => 'Neaišku ar garantinis', 'Garantinis' => 'Garantinis', 'Negarantinis' => 'Negarantinis'], null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('Dalių kaina') !!}
                    {!! Form::text('daliu_kaina',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Remonto kaina') !!}
                    {!! Form::text('remonto_kaina',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Specifikacija') !!}
                    {!! Form::textarea('spec_komp',null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Gedimai') !!}
                    {!! Form::textarea('gedimai',null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Pastabos') !!}
                    {!! Form::textarea('pastabos',null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>
                {{Form::submit('Pridėti', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
        </div>
        </div>
    </div>
</div>

<script>
    datepickr('.date', { dateFormat: 'Y-m-d'});
</script>

@endsection
