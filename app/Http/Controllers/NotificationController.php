<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Request as req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\request_notification_event;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        return view($role . '.make_request');
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

        $dep_id = Department::all()->where('name', '=', 'purchasing')->value('id');

        $noti = new Notification();
        $noti->sender_emp_id = strval(Auth::user()->id);
        $noti->receiver_dep_id = $dep_id;
        $noti->seen = '0';

        $r = new req();
        $r->emp_id = strval(Auth::user()->id);
        $r->request = $request->request_name;
        $r->description = $request->description;
        $r->quantity = $request->quantity;
        $r->save();

        $noti->request_id = strval($r->id);

        $noti->save();

        $role = Auth::user()->role;
        return redirect()->route($role . '.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp_id = Notification::all()->where('id', '=', $id)->value('sender_emp_id');
        $person_id = Employee::all()->where('id', '=', $emp_id)->value('person_id');
        $fname = Person::all()->where('id', '=', $person_id)->value('fname');
        $lname = Person::all()->where('id', '=', $person_id)->value('lname');
        $job_title = Employee::all()->where('id', '=', $emp_id)->value('title');
        $req_id = Notification::all()->where('id', '=', $id)->value('request_id');
        $req = req::all()->where('id', '=', $req_id)->value('request');
        $req_desc = req::all()->where('id', '=', $req_id)->value('description');
        $req_quantity = req::all()->where('id', '=', $req_id)->value('quantity');
        $created_at = Notification::all()->where('id', '=', $id)->value('created_at');
        $role = Auth::user()->role;
        return view($role . '.notification_details', [
            'fname' => $fname, 'lname' => $lname, 'job_title' => $job_title, 'req' => $req, 'req_desc' => $req_desc,
            'req_quantity' => $req_quantity, 'created_at' => $created_at, 'id' => $id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function dismiss($id)
    {
        $noti = Notification::where('id', '=', $id)->update(['seen' => '1']);
        $role = Auth::user()->role;
        return redirect()->route($role . '.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
