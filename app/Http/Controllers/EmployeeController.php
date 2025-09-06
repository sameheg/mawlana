<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function create(): View
    {
        return view('employee.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'hourly_rate' => 'required|numeric',
        ]);

        Employee::create($data);

        return redirect()->back();
    }

    public function salary(Employee $employee, Request $request): JsonResponse
    {
        $data = $request->validate([
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        $total = $employee->salaryFor($data['from'], $data['to']);

        return response()->json(['salary' => $total]);
    }
}
