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
        if (Auth::user()->role == 'employee') {
            $manager_id = Employee::all()->where('dep_id', '=', Auth::user()->dep_id)
                ->where('role', '=', 'manager')
                ->value("id");
            $noti = new Notification();
            $noti->sender_emp_id = Auth::user()->id;
            $noti->receiver_emp_id = $manager_id;

            $r = new req();
            $r->emp_id = Auth::user()->id;
            $r->request = $request->request_name;
            $r->description = $request->description;
            $r->quantity = $request->quantity;
            $r->status = 'Waiting';
            $r->save();

            $noti->request_id = $r->id;

            $noti->save();
        } else {
            $dep_id = Department::all()->where('name', '=', 'purchasing')->value('id');

            $noti = new Notification();
            $noti->sender_emp_id = Auth::user()->id;
            $noti->receiver_dep_id = $dep_id;


            $r = new req();
            $r->emp_id = Auth::user()->id;
            $r->request = $request->request_name;
            $r->description = $request->description;
            $r->quantity = $request->quantity;
            $r->status = 'Waiting';
            $r->save();

            $noti->request_id = $r->id;

            $noti->save();
        }

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
        Notification::where('id', '=', $id)->update(['seen' => '1']);
        req::where('id', '=', Notification::all()->where('id', '=', $id)->value('request_id'))->update(['status' => 'dismissed by manager']);
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
    public function approve($id)
    {
        Notification::where('id', '=', $id)->update(['seen' => '1']);

        $dep_id = Department::all()->where('name', '=', 'purchasing')->value('id');
        $request_id = Notification::all()->where('id', '=', $id)->value('request_id');

        $noti = new Notification();
        $noti->sender_emp_id = strval(Auth::user()->id);
        $noti->receiver_dep_id = $dep_id;
        $noti->request_id = $request_id;

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
    public function accept($id)
    {
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
