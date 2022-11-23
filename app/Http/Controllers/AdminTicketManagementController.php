<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminTicketManagementRequest;
use App\Http\Requests\UpdateAdminTicketManagementRequest;
use App\Models\AdminTicketManagement;

class AdminTicketManagementController extends Controller
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
     * @param  \App\Http\Requests\StoreAdminTicketManagementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminTicketManagementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminTicketManagement  $adminTicketManagement
     * @return \Illuminate\Http\Response
     */
    public function show(AdminTicketManagement $adminTicketManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminTicketManagement  $adminTicketManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminTicketManagement $adminTicketManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminTicketManagementRequest  $request
     * @param  \App\Models\AdminTicketManagement  $adminTicketManagement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminTicketManagementRequest $request, AdminTicketManagement $adminTicketManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminTicketManagement  $adminTicketManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminTicketManagement $adminTicketManagement)
    {
        //
    }
}
