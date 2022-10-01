<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Receipt;
use App\Models\Request as req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\request_notification_event;
use App\Models\Offer;

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
     * Display the specified resource.
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markasread($id)
    {
        Notification::where('id', '=', $id)->update(['seen' => '1']);
        $role = Auth::user()->role;
        return redirect()->route($role . '.dashboard');
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
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send_to_manager($id, Request $request)
    {
        $manager_id = Employee::all()->where('dep_id', '=', Auth::user()->dep_id)
            ->where('role', '=', 'manager')
            ->value("id");
        req::where('id', '=', $id)->update(['status' => 'accepted']);

        $noti = new Notification();
        $noti->sender_emp_id = Auth::user()->id;
        $noti->receiver_emp_id = $manager_id;
        $noti->request_id = $id;
        $noti->type = 'RTFO';
        $noti->save();

        return redirect()->route('employee.dashboard.orders');
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
            $r->status = 'waiting';
            $r->save();

            $noti->request_id = $r->id;
            $noti->type = 'R';

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
            $r->status = 'waiting';
            $r->save();

            $noti->request_id = $r->id;
            $noti->type = 'R';
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
        $type = Notification::all()->where('id', '=', $id)->value('type');
        if ($type == 'RTFO') {
            $offers = Offer::all()->where('req_id', '=', $req_id)
                ->where('chosen', '=', '0');
            // dd($offers);
            return view($role . '.notification_details_for_order', [
                'fname' => $fname, 'lname' => $lname, 'job_title' => $job_title, 'req' => $req, 'req_desc' => $req_desc,
                'req_quantity' => $req_quantity, 'created_at' => $created_at, 'id' => $id, 'offers' => $offers, 'type' => $type
            ]);
        }
        if ($type == 'AA') {
            $offer = Offer::all()->where('req_id', '=', $req_id)
                ->where('chosen', '=', '1');

            return view($role . '.notification_details_for_order', [
                'fname' => $fname, 'lname' => $lname, 'job_title' => $job_title, 'req' => $req, 'req_desc' => $req_desc,
                'req_quantity' => $req_quantity, 'created_at' => $created_at, 'id' => $id, 'offer' => $offer, 'type' => $type
            ]);
        }

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

        $sender_emp_id = Notification::all()->where('id', '=', $id)->value('sender_emp_id');
        $request_id = Notification::all()->where('id', '=', $id)->value('request_id');

        $noti_to_emp = new Notification();
        $noti_to_emp->sender_emp_id = Auth::user()->id;
        $noti_to_emp->receiver_emp_id = $sender_emp_id;
        $noti_to_emp->request_id = $request_id;

        $noti_to_emp->type = 'MSGDISSMISS';
        $noti_to_emp->save();

        $role = Auth::user()->role;
        return redirect()->route($role . '.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve($id, Request $request)
    {
        Notification::where('id', '=', $id)->update(['seen' => '1']);

        $type = Notification::where('id', '=', $id)->value('type');
        if ($type == 'R') {
            $dep_id = Department::all()->where('name', '=', 'purchasing')->value('id');
            $request_id = Notification::all()->where('id', '=', $id)->value('request_id');

            $noti = new Notification();
            $noti->sender_emp_id = Auth::user()->id;
            $noti->receiver_dep_id = $dep_id;
            $noti->request_id = $request_id;

            $noti->type = 'R';
            $noti->save();

            $sender_emp_id = Notification::all()->where('id', '=', $id)->value('sender_emp_id');
            $noti_to_emp = new Notification();
            $noti_to_emp->sender_emp_id = Auth::user()->id;
            $noti_to_emp->receiver_emp_id = $sender_emp_id;
            $noti_to_emp->request_id = $request_id;

            $noti_to_emp->type = 'MSG';
            $noti_to_emp->save();
        } else if ($type == 'RTFO') {
            Offer::where('id', '=', $request->offer_id)->update(['chosen' => '1']);
            $dep_id = Department::all()->where('name', '=', 'accounting')->value('id');
            $request_id = Notification::all()->where('id', '=', $id)->value('request_id');
            $manager_id = Employee::all()->where('dep_id', '=', $dep_id)
                ->where('role', '=', 'manager')
                ->value("id");

            $noti = new Notification();
            $noti->sender_emp_id = Auth::user()->id;
            $noti->receiver_emp_id = $manager_id;
            $noti->request_id = $request_id;
            $noti->type = 'AA';
            $noti->save();
        } else {
            $request_id = Notification::all()->where('id', '=', $id)->value('request_id');
            $accept_emp_id = req::all()->where('id', '=', $request_id)->value('accept_emp_id');
            $quantity = req::all()->where('id', '=', $request_id)->value('quantity');
            $price = Offer::all()->where('req_id', '=', $request_id)
                ->where('chosen', '=', '1')->value('price');

            $receipte = new Receipt();
            $receipte->emp_id = Auth::user()->id;
            $receipte->accept_emp_id = $accept_emp_id;
            $receipte->request_id = $request_id;
            $receipte->total_price = intval($quantity) * intval($price);

            $receipte->save();
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
    public function accept($id)
    {
        Notification::where('id', '=', $id)->update(['seen' => '1']);
        $request_id = Notification::all()->where('id', '=', $id)->value('request_id');
        req::where('id', '=', $request_id)->update(['accept_emp_id' => Auth::user()->id]);

        return redirect()->route('employee.dashboard.orders');
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
