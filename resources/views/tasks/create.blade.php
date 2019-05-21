<div class="modal fade" id="calendarCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Sukurti įrašą</h4>
                    {!! Form::open(['action' => ['TasksController@store'], 'method' => 'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('Pavadinimas') !!}
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Aprašymas') !!}
                            {!! Form::textarea('description',null, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Data') !!}<br>
                            {!! Form::text('task_date',null, ['class' => 'form-control date']) !!}
                        </div>
                    {{Form::submit('Išsaugoti', ['class' => 'btn btn-primary float-left'])}}
                    {!! Form::close() !!}
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
    datepickr('.date', { dateFormat: 'Y-m-d'});
</script>