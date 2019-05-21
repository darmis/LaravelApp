@extends('layouts.app')

@section('content')
<div class="justify-content-center">
        <div class="py-2">
            <div class="card">
                <div class="card-header text-center text-uppercase"><h4>{{$name}}</h4></div>
    
                <div class="card-body">
                    @include('tasks.calendar')
                </div>
            </div>
        </div>
    </div>
@endsection