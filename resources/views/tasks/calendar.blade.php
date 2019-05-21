
<link href='{{ asset('packages/fullCalendar/core/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/fullCalendar/daygrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/fullCalendar/timegrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/fullCalendar/list/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/datepicker/datepicker.min.css') }}' rel='stylesheet' />
<script src='{{ asset('packages/fullCalendar/core/main.js') }}'></script>
<script src='{{ asset('packages/fullCalendar/core/locales-all.js') }}'></script>
<script src='{{ asset('packages/fullCalendar/interaction/main.js') }}'></script>
<script src='{{ asset('packages/fullCalendar/daygrid/main.js') }}'></script>
<script src='{{ asset('packages/fullCalendar/timegrid/main.js') }}'></script>
<script src='{{ asset('packages/fullCalendar/list/main.js') }}'></script>
<script src='{{ asset('packages/datepicker/datepicker.min.js') }}'></script>
<script src='{{ asset('packages/moment.js') }}'></script>

@include('tasks.create')
@include('tasks.edit')
<div id='calendar'></div>


<script>
    moment().format();
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            defaultDate: '2019-04-12',
            locale: 'lt',
            timeZone: 'local',
            buttonIcons: false, // show the prev/next text
            weekNumbers: false,
            fixedWeekCount: false,
            aspectRatio: 2,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                @foreach($tasks as $task)
                {
                id: '{{ $task->id }}',
                title: '{{ $task->name }}',
                description: '{{ $task->description }}',
                start: '{{ $task->task_date }}',
                // url: '{{ route('tasks.edit', $task->id) }}'
                },
                @endforeach
            ],
            eventDrop: function(eventDropInfo) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/updateDate') }}",
                    type: "post",
                    data: {
                        id : eventDropInfo.event.id,
                        date: moment(eventDropInfo.event.start).format('YYYY-MM-DD')
                    }
                });
            },
            dateClick: function(info) {
                $('input[name="task_date"]').val(info.dateStr);
                $('#calendarCreateModal').modal('show');
            },
            eventClick: function(info) {
                $('input[name="id"]').val(info.event.id);
                $('input[name="editTitle"]').val(info.event.title);
                $('textarea[name="editDescription"]').val(info.event.extendedProps.description);
                $('input[name="editDate"]').val(moment(info.event.start).format('YYYY-MM-DD'));
                $('#calendarEditModal').modal('show');
            },
            eventRender: function(info) {
                info.el.setAttribute('title', info.event.extendedProps.description);
            }
        });

    calendar.render();
});
</script>