@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-header text-center text-uppercase"><h4>{{$name}}</h4></div>

            <div class="card-body">

                <h3> 
                    @if($role <= 1)
                    <span class="float-left py-2"><a href="/clients/create" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createClientModal">Pridėti naują</a></span>
                    @endif
                </h3>
                @if(count($clients))
                    <table class="table table-sm table-hover table-striped">
                        <tr>
                            <th>Veiksmai</th>
                            <th>ID</th>
                            <th>Pavadinimas</th>
                            <th>Kontaktinis asmuo</th>
                            <th>Tel. nr.</th>
                            <th>Mob. nr.</th>
                            <th>Adresas</th>
                            <th>Atstumas</th>
                            <th>Įmonės kodas</th>
                            <th>PVM kodas</th>
                        </tr>
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <div class="row">
                                        <span><a href="/clients/{{$client->id}}" class="btn btn-primary btn-sm center"><i class="fa fa-search"></i></a></span>
                                    @if($role <= 1)
                                        <span><a href="/clients/{{$client->id}}/edit" class="btn btn-success btn-sm center"><i class="fa fa-edit"></i></a></span>
                                        <span>
                                            {!! Form::open(['action' => ['ClientController@destroy', $client->id], 'method' => 'POST', 'class' => 'center', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'])}}
                                            {!! Form::close() !!}
                                        </span>
                                    @endif
                                    </div>
                                </td>
                                <td>{{$client->id}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->kontakto_vardas}}</td>
                                <td>{{$client->tel}}</td>
                                <td>{{$client->mob}}</td>
                                <td>{{$client->address}}</td>
                                <td>{{$client->atstumas}}</td>
                                <td>{{$client->im_kodas}}</td>
                                <td>{{$client->pvm_kodas}}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{$clients->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal CREATE-->
<div class="modal fade" id="createClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Naujas įrašas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['action' => 'ClientController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('Pavadinimas') !!}
                    {!! Form::text('name',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{Form::label('Kontaktinis asmuo')}}
                    {{Form::text('kontakto_vardas', null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('Tel. nr') !!}
                    {!! Form::text('tel',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Mob. Nr') !!}
                    {!! Form::text('mob',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Adresas') !!}
                    {!! Form::text('address',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Atstumas') !!}
                    {!! Form::text('atstumas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Įimonės kodas') !!}
                    {!! Form::text('im_kodas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('PVM kodas') !!}
                    {!! Form::text('pvm_kodas',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Užrašai') !!}
                    {!! Form::textarea('uzrasai',null, ['class' => 'form-control']) !!}
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
