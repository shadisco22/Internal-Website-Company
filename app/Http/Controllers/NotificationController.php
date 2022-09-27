<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Department;
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
        return view('admin.make_request');
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

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
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
