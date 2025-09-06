<form method="POST" action="/schedules">
    @csrf
    <select name="employee_id">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
    </select>
    <input type="datetime-local" name="start_time">
    <input type="datetime-local" name="end_time">
    <input type="number" step="0.01" name="hourly_rate" placeholder="Hourly Rate">
    <button type="submit">Save</button>
</form>
