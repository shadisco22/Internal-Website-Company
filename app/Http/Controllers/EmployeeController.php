<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use App\Models\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $departments = Department::all();
        $people = Person::all();
        return view('superadmin.employees', ['employees' => $employees, 'departments' => $departments, 'people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = new person();
        $employee = new Employee();

        $person->fname = $request->fname;
        $person->lname = $request->lname;
        $person->gender = $request->gender;
        $person->email = $request->p_email;
        $person->phonenumber = $request->phonenumber;
        $person->address = $request->address;
        $person->dob = $request->day . "-" . $request->month . "-" . $request->year;
        $person->save();

        $employee->person_id = $person->id;
        $employee->dep_id = $request->department_id;
        $employee->title = $request->title;
        $employee->role = $request->role;
        $employee->duties = $request->duties;
        $employee->salary = $request->salary;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->hire_date = date('d-m-y');
        $employee->save();

        return redirect()->route('superadmin.employee.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employees = Employee::all();
        $departments = Department::all();
        $people = Person::all();
        return view('superadmin.employees_show', ['employees' => $employees, 'departments' => $departments, 'people' => $people]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
