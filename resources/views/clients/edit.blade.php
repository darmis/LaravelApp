@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-body">
                @if(isset($client))
                {!! Form::open(['action' => ['ClientController@update', $client->id], 'method' => 'POST']) !!}
                {{Form::hidden('_method', 'PUT')}}
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                {!! Form::label('ID') !!}
                                {!! Form::text('id',$client->id, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                {!! Form::label('Pavadinimas') !!}
                                {!! Form::text('name',$client->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Kontaktinis asmuo') !!}
                                {!! Form::text('kontakto_vardas',$client->kontakto_vardas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Mob. nr') !!}
                                {!! Form::text('mob',$client->mob, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Tel. nr') !!}
                                {!! Form::text('tel',$client->tel, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Adresas') !!}
                                {!! Form::text('address',$client->address, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Atstumas') !!}
                                {!! Form::text('atstumas',$client->atstumas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Įmonės kodas') !!}
                                {!! Form::text('im_kodas',$client->im_kodas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('PVM kodas') !!}
                                {!! Form::text('pvm_kodas',$client->pvm_kodas, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr class="py-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Užrašai') !!}
                                {!! Form::textarea('uzrasai',$client->uzrasai, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                <div>
                    {{Form::submit('Išsaugoti', ['class' => 'btn btn-primary'])}}
                </div>
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection