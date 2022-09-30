<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Error\Notice;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        return view($role . ".show_requests");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $role = Auth::user()->role;
        $show_request = ModelsRequest::all()->where('emp_id', '=', Auth::user()->id);   // all request from current employee
        return view($role . ".show_requests", ['requests' => $show_request]);
    }

    public function show_orders()
    {
        $orders = ModelsRequest::all()->where('accept_emp_id', '=', Auth::user()->id)
            ->where('status', '=', 'waiting');


        return view("employee.show_orders", ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete_accepted_request($id)
    {
        ModelsRequest::where('id', '=', $id)
            ->where('accept_emp_id', '=', Auth::user()->id)->update(['accept_emp_id' => null]);

        Notification::where('request_id', '=', $id)
            ->where('receiver_emp_id', '=', null)
            ->update(['seen' => '0']);

        offer::where('req_id', '=', $id)->delete();

        return redirect()->route('employee.dashboard.orders');
    }
           /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inprogress_orders()
    {
        $role = Auth::user()->role;
        $offers=Offer::all();
        $employees=Employee::all();
        $departments=Department::all();
        $inprogress=ModelsRequest::all()->where('accept_emp_id', '=', Auth::user()->id)->where('status','=','in-progress');
        return view($role . ".inprogress_orders",['inprogress' => $inprogress,'offers'=>$offers,'departments'=>$departments,'employees'=>$employees]);
    }
}
