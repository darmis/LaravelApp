@extends('layouts.app')
@section('content')
<div class="justify-content-center">
    <div class="py-2">
        <div class="card">
            <div class="card-header text-center text-uppercase"><h4>Remonto paieška</h4></div>

            <div class="card-body">
            <div class="text-center">
                <h4>
                    {{ isset($busena) ? 'Jūsų įrenginys šiuo metu: ' : '' }}
                    <span style="color: red;">{{isset($busena) ? $busena : ''}}</span>
                </h4>
            </div>
                {!! Form::open(['action' => 'RepairsController@publicSearch', 'method' => 'GET']) !!}
    
                    {!! Form::label('Sutarties Nr.') !!}
                    {!! Form::text('nr',null, ['class' => 'form-control']) !!}
            
                    {{Form::submit('Ieškoti', ['class' => 'btn btn-primary btn-block'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
