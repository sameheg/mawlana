<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\ShiftSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function create(): View
    {
        return view('attendance.create', [
            'employees' => Employee::all(),
            'schedules' => ShiftSchedule::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_schedule_id' => 'required|exists:shift_schedules,id',
        ]);

        Attendance::create([
            'employee_id' => $data['employee_id'],
            'shift_schedule_id' => $data['shift_schedule_id'],
            'clock_in_at' => now(),
        ]);

        return redirect()->back();
    }

    public function clockOut(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
        ]);

        $attendance = Attendance::findOrFail($data['attendance_id']);
        $attendance->close();

        return redirect()->back();
    }
}
