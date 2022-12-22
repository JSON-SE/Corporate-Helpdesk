<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Office;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminTicketManagement;
use Illuminate\Support\Facades\Request;
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
        // return where id is assigned to users id
        return Inertia::render('Task/Index', [
            'tickets' => Ticket::where('user_id', Auth::id())
            ->when(Request::input('search'), function ($query, $requestor) {
                $query->where('requestor', 'like', "%{$requestor}%")
                ->orWhere('reference_number', 'like', "%{$requestor}%");
            })
            ->when(Request::input('categoryFilter'), function ($query, $category) {
                $query->where('category_id', '=', $category);
            })
            ->when(Request::input('statusFilter'), function ($query, $statusFilter) {
                $query->where('status_id', '=', $statusFilter);
            })
            ->when(Request::input('officeFilter'), function ($query, $officeFilter) {
                $query->where('office_id', '=', $officeFilter);
            })
            ->with('users', 'categories', 'statuses')
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($ticket) => [
                'id' => $ticket->id,
                'category' => $ticket->categories->category,
                'reference_number' => $ticket->reference_number,
                'title' => $ticket->title,
                'content' => $ticket->content,
                'user' => $ticket->requestor,
                'office' => $ticket->users->offices->abbr,
                'status' => $ticket->statuses->status,
                'created_at' => $ticket->created_at->toDayDateTimeString(),
                'view_url' => URL::route('ticket.show', $ticket),
                'destroy_url' => URL::route('ticket.destroy', $ticket)
            ]),
            'filters' => Request::only(['search', 'categoryFilter', 'statusFilter', 'officeFilter']),
            'offices' => Office::all(),
            'categories' => Category::all(),
            'statuses' => Status::all(),
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
        $activitySender = Activity::where('ticket_id', $id)->first();
        // dd($activitySender);
        // Update Ticket Model Status to "In-progress"
        $ticket->status_id = 2; // In-progress
        $activitySender->status = 'read';
        $activitySender->save();
        $ticket->save();
        // Record the ff. to admin_ticket_management_table
        // ticket_id, user_id -> auth->user()->id, status_id -> "In-progress"
        AdminTicketManagement::create([
            'ticket_id' => $id,
            'user_id' => Auth::id(),
            'status_id' => 2 // In-progress
        ]);
        // Record Activity Comment
        Activity::create([
            'ticket_id' => $id,
            'sender_id' => Auth::id(),
            // sender should receiver a notification that assigned user accepts the request
            'receiver_id' => $activitySender->sender_id,
            'activity_type_id' => 2, // assignment
            'comment' => 'has accepted your request.',
        ]);
        // return Inertia::render('Dashboard')->with('ticketAccepted', 'ticket has been accepted');
        return back()->with('ticketAccepted', 'ticket has been accepted');
    }

    public function decline($id)
    {
        $query = Ticket::where('id', $id)->first();
        $activitySender = Activity::where('ticket_id', $id)->first();
        $activitySender->status = 'read';
        $activitySender->save();

        // cancel ticket
        $query->status_id = 3;
        $query->save();

        // Activity Store Comment
        $activity = Activity::create([
            'ticket_id' => $id,
            'sender_id' => Auth::id(),
            // sender should receiver a notification that assigned user cancelled the request
            'receiver_id' => $activitySender->sender_id,
            'activity_type_id' => 2, // assignment type
            'comment' => 'has cancelled the ticket.'
        ]);

        return back()->with('ticketCancelled', 'Ticket has been cancelled.');
    }
}
