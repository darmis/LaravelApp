<div class="modal fade" id="calendarEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Taisyti įrašą</h4>
    
                    {{-- <form action="{{ route('tasks.update') }}" method="post">
                        {{ csrf_field() }}

                        Task name:
                        <br />
                        <input type="text" name="editTitle" />
                        <br /><br />
                        Task description:
                        <br />
                        <textarea name="editDescription"></textarea>
                        <br /><br />
                        Start time:
                        <br />
                        <input type="text" name="editDate" class="date" />
                        <br /><br />
                        <input type="submit" value="Save" />
                    </form> --}}
                    {!! Form::open(['action' => ['TasksController@updateTask'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {!! Form::text('id',null, ['class' => 'form-control hidden']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Pavadinimas') !!}
                                    {!! Form::text('editTitle',null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Aprašymas') !!}
                                    {!! Form::textarea('editDescription',null, ['class' => 'form-control', 'rows' => '3']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Data') !!}<br>
                                    {!! Form::text('editDate',null, ['class' => 'form-control date']) !!}
                                </div>
                    {{Form::submit('Išsaugoti', ['class' => 'btn btn-primary float-left'])}}
                    {!! Form::close() !!}
                    {!! Form::open(['action' => ['TasksController@deleteTask'], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {!! Form::text('id',null, ['class' => 'form-control hidden']) !!}
                                </div>
                    {{Form::submit('Ištrinti', ['class' => 'btn btn-danger float-left'])}}
                    {!! Form::close() !!}
                </div>
                
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                </div>
            </div>
        </div>
    </div>


<script>
    datepickr('.date', { dateFormat: 'Y-m-d'});
</script>