@extends('layouts.app')

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

                <h3> 
                    @if($role <= 1)
                    <span class="float-left py-2"><a href="/services/create" class="btn btn-success" data-toggle="modal" data-target="#createServiceModal">Pridėti naują</a></span>
                    @endif
                    <div class="float-right py-2"><button class="btn btn-primary search-btn">Filtrai</button></div>
                </h3>

                <div class="search-form hidden">
                        {!! Form::open(['action' => 'ServiceController@search', 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('ID') !!}
                                    {!! Form::text('id',null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('Nuo') !!}<br>
                                    {!! Form::text('nuo',null, ['class' => 'form-control date']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('Iki') !!}<br>
                                    {!! Form::text('iki',null, ['class' => 'form-control date']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('Klientas') !!}
                                    {!! Form::text('klientas',null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('Meistras') !!}
                                    {!! Form::select('meistro_id', $userOptions, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('Būsena') !!}
                                    {!! Form::text('busena',null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                {{Form::submit('Ieškoti', ['class' => 'btn btn-primary btn-block'])}}
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    {!! Form::close() !!}
                </div>

                @if(count($services))
                    <table class="table table-sm table-hover table-striped">
                        <tr>
                            <th>Rodo</th>
                            <th>Veiksmai</th>
                            <th>Klientas / Tel</th>
                            <th>Būsena</th>
                            <th>Užduotis</th>
                            <th>Atlikti darbai</th>
                            <th>Adresas / Atstumas</th>
                            <th>Dirbta valandų</th>
                            <th>Meistras / Registratorius</th>
                            <th>Priregistruota</th>
                        </tr>
                        @foreach($services as $service)
                            <tr>
                                <td><input class="isShowingService" data-showing-id={{$service->id}} type="checkbox" name="arRodo" {{$service->arRodo ? 'checked' : ''}}></td>
                                <td>
                                    <div class="row">
                                        <span><a href="/services/{{$service->id}}" class="btn btn-primary btn-sm center"><i class="fa fa-search"></i></a></span>
                                        <span><a href="/services/{{$service->id}}/print" target="_blank" class="btn btn-secondary btn-sm center"><i class="fa fa-print"></i></a></span>
                                    @if($role <= 1)
                                        <span><a href="/services/{{$service->id}}/edit" class="btn btn-success btn-sm center"><i class="fa fa-edit"></i></a></span>
                                        <span>
                                            {!! Form::open(['action' => ['ServiceController@destroy', $service->id], 'method' => 'POST', 'class' => 'center', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
                                            {!! Form::close() !!}
                                        </span>
                                    @endif
                                    </div>
                                </td>
                                <td>{{$service->klientas}}<br>{{$service->tel}}</td>
                                <td>{{$service->busena}}</td>
                                <td>{{$service->uzduotis}}</td>
                                <td>{{$service->atlikta}}</td>
                                <td>{{$service->adresas}}<br>{{$service->atstumas}}</td>
                                <td>{{$service->dirbta_val}}</td>
                                <td>{{$userOptions[$service->meistro_id]}}<br>{{$userOptions[$service->registrator_id]}}</td>
                                <td>{{$service->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal CREATE-->
<div class="modal fade" id="createServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Naujas įrašas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['action' => 'ServiceController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('Klientas') !!}
                    {!! Form::text('klientas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Telefonas') !!}
                    {!! Form::text('tel',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Adresas') !!}
                    {!! Form::text('adresas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Atstumas') !!}
                    {!! Form::text('atstumas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Darbo laikas') !!}
                    {!! Form::text('darbo_laikas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Užduotis') !!}
                    {!! Form::textarea('uzduotis',null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Atlikti darbai') !!}
                    {!! Form::textarea('atlikta',null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>
                <div class="form-group">
                    {{Form::label('Meistras', null, ['class' => 'control-label'])}}
                    {{Form::select('meistro_id', $userOptions, null, ['class'=>'form-control']) }}
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

@endsection
