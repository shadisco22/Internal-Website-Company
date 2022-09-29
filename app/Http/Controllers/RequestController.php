<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}