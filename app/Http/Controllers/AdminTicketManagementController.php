<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminTicketManagement;
use App\Http\Requests\AcceptTicketRequest;
use App\Http\Requests\StoreAdminTicketManagementRequest;
use App\Http\Requests\UpdateAdminTicketManagementRequest;

class AdminTicketManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('return all in-progress tickets');
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

    public function accept(AcceptTicketRequest $request, $id)
    {
        $ticket = Ticket::where('id', $id)->first();
        // Update Ticket Model Status to "In-progress"
        $ticket->status_id = 2; // In-progress
        $ticket->save();
        // Record the ff. to admin_ticket_management_table
        // ticket_id, user_id -> auth->user()->id, status_id -> "In-progress"
        AdminTicketManagement::create([
            'ticket_id' => $id,
            'user_id' => Auth::id(),
            'status_id' => 2 // In-progress
        ]);

        return back()->with('ticketAccepted', 'ticket has been accepted');
    }
}
