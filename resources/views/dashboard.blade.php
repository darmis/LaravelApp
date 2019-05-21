@extends('layouts.app')

@section('content')
<div class="justify-content-center">
        <div class="row">
                <div class="col-xl-3 col-lg-6 ">
                    <div class="new-tasks">
                        <div class="widget-text">
                            <i class="fa fa-file-o"></i>
                            <div>Naujos užduotys</div><br>
                            <div class="widget-number"><a href="/newRepairs">Remontas: {{$countRepairs}}</a><br>
                                <a href="/newServices">Iškvietimai: {{$countServices}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 ">
                    <div class="not-finished-tasks">
                        <div class="widget-text">
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                <div>Nebaigtos užduotys</div><br>
                                <div class="widget-number"><a href="/notFinishedRepairs">Remontas: {{$countNotFinishedRepairs}}</a><br>
                                    <a href="/notFinishedServices">Iškvietimai: {{$countNotFinishedServices}}</a>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 ">
                    <div class="month-repairs">
                        <div class="widget-text">
                            <a href="/thisMonthRepairs">
                                <i class="fa fa-bar-chart"></i>
                                <div>Šio mėnesio remontai</div><br>
                                <div class="widget-number">{{$countThisMonthRepairs}}</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 ">
                    <div class="month-services">
                        <div class="widget-text">
                            <a href="/thisMonthServices">
                                <i class="fa fa-pie-chart"></i>
                                <div>Šio mėnesio iškvietimai</div><br>
                                <div class="widget-number">{{$countThisMonthServices}}</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-8 col-lg-12 ">
                    @include('tasks.calendar')
                </div>
                <div class="col-xl-4 col-lg-12 ">
                    <div class="panel">
                        <div class="panel-header">
                            <i class="fa fa-book"></i> Užrašai
                        </div>
                        <div class="panel-body">
                            <textarea class="dashboard-note">{{$note}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dashboard-note').on('input', function() {
            var text = $('.dashboard-note').val();

            $.ajax({
                type: "get",
                url: "{{ url('/trackNote') }}",
                data: { content: text }
            });
        });
    });
    
</script>

@endsection
