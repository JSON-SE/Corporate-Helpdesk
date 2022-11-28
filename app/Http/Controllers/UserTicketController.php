<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTicketRequest;
use App\Http\Requests\UpdateUserTicketRequest;
use App\Models\UserTicket;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreUserTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function show(UserTicket $userTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTicket $userTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserTicketRequest  $request
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserTicketRequest $request, UserTicket $userTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTicket $userTicket)
    {
        //
    }
}
