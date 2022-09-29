<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Request as req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('employee.make_offer', ['request_id' => $id]);
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
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {

        $offer = new Offer();
        $offer->offer = $request->offer;
        $offer->price = $request->price;
        $offer->req_id = $id;
        $offer->seen = 0;
        $offer->accept_emp_id = Auth::user()->id;
        $offer->save();

        return redirect()->route('employee.offer', $id);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offers = Offer::all()->where('req_id', '=', $id)
            ->where('accept_emp_id', '=', Auth::user()->id);

        return view('employee.show_offers', ['offers' => $offers, 'request_id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
