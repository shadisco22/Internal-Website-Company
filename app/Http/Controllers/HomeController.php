<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Employee;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $noti = Notification::all()
            ->where('receiver_emp_id', '=', Auth::user()->id)
            ->where('seen', '=', '0');

        $employees = Employee::all();
        $people = Person::all();

        $role = Auth::user()->role;
        return view($role . '.dashboard', ['noti' => $noti, 'employees' => $employees, 'people' => $people]);
    }
}
