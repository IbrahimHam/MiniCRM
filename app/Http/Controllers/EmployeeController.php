<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('companies')->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::select(['id', 'name'])->get();

        return view('employees.create',compact('companies'));
    }

    public function store(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $company_id = $request->company_id;
        $email = $request->email;
        $phone = $request->phone;

        if(!$this->checkIfExist($request) && $this->isValid($request))
        {
            $employee = Employee::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'company_id' => $company_id,
                'email' => $email,
                'phone' => $phone,
            ]);
            return redirect()
                ->route('employees.index')
                ->with('success','Employee has been created successfully.');
        }
        return redirect()
            ->route('employees.index')
            ->with('status', $request->get('email').' cant be registered with the same company twice!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::select(['id', 'name'])->get();

        return view('employees.edit', compact('companies'), compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $checker = Employee::where('email', $request->get('email'))
            ->where('company_id', $request->get('company_id'))
            ->first();

        if($checker !== null)
        {
            return redirect()
                ->route('employees.edit', $checker)
                ->with('status', $request->get('email').' cant be registered with the same company twice!');
        }

        $request->validate([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $request->company_id,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        return redirect()
            ->route('employees.index')
            ->with('success','Employee Has Been updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success','Employee has been deleted successfully');
    }

    public function checkIfExist($request): bool
    {
        $checker = Employee::where('email', $request
            ->get('email'))
            ->where('company_id', $request->get('company_id'))->first();

        return (bool)$checker;
    }

    public function isValid($request): bool
    {
        $valid = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        return (bool)$valid;
    }
}
