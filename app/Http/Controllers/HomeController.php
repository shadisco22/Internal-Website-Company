<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Request as req;
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
        $noti_dep = Notification::all()
            ->where('receiver_dep_id', '=', Department::all()
                ->where('name', '=', 'purchasing')->value('id'))
            ->where('seen', '=', '0');

        $department_name = Department::all()
            ->where('id', '=', Employee::all()
                ->where('id', '=', Auth::user()->id)->value('dep_id'))->value('name');

        $employees = Employee::all();
        $people = Person::all();
        $requests = req::all();
        $offers = Offer::all()->where('chosen', '=', '1');

        $role = Auth::user()->role;
        return view($role . '.dashboard', [
            'noti' => $noti, 'employees' => $employees, 'people' => $people,
            'department_name' => $department_name,
            'noti_dep' => $noti_dep,
            'requests' => $requests,
            'offers' => $offers
        ]);
    }
}
