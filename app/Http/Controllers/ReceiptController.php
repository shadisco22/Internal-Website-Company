<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Person;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Offer;
use App\Models\Request as req;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Receipt::all()->where('payed', '=', '0');
        $people = Person::all();
        $deps = Department::all();
        $employees = Employee::all();
        $requests = req::all();
        $offers = Offer::all();

        return view('employee.show_receipts', [
            'receipts' => $receipts, 'people' => $people,
            'deps' => $deps, 'employees' => $employees,
            'requests' => $requests, 'offers' => $offers
        ]);
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pay($id, Request $request)
    {
        Receipt::where('id', '=', $id)->update(['payed' => '1']);
        $req_id = Receipt::all()->where('id', '=', $id)->value('request_id');
        req::where('id', '=', $req_id)->update(['status' => 'in-progress']);

        return redirect()->route('employee.dashboard.receipts');
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
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
