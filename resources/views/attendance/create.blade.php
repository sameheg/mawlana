<form method="POST" action="/attendance">
    @csrf
    <select name="employee_id">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
    </select>
    <select name="shift_schedule_id">
        @foreach ($schedules as $schedule)
            <option value="{{ $schedule->id }}">{{ $schedule->start_time }} - {{ $schedule->end_time }}</option>
        @endforeach
    </select>
    <button type="submit">Clock In</button>
</form>

<form method="POST" action="/attendance/clock-out">
    @csrf
    <input type="number" name="attendance_id" placeholder="Attendance ID">
    <button type="submit">Clock Out</button>
</form>
