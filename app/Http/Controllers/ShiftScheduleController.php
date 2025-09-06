<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ShiftSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShiftScheduleController extends Controller
{
    public function create(): View
    {
        return view('shift_schedule.create', [
            'employees' => Employee::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'hourly_rate' => 'required|numeric',
        ]);

        ShiftSchedule::create($data);

        return redirect()->back();
    }
}
