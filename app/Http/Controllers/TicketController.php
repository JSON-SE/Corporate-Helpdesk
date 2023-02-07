<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Office;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Activity;
use App\Models\Category;
use App\Models\UserTicket;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    public function index()
    {
        // UserTicket
        return Inertia::render('Ticket/Index', [
            'tickets' => UserTicket::where('user_id', Auth::id())
            ->when(Request::input('search'), function ($query, $requestor) {
                $query->whereHas('tickets', function ($query) {
                    $query->where('tickets.requestor', 'like', '%' . Request::input('search') . '%');
                    $query->orWhere('tickets.reference_number', 'like', '%' . Request::input('search') . '%');
                });
            })
            ->when(Request::input('categoryFilter'), function ($query, $category) {
                $query->whereHas('tickets', function ($query) {
                    $query->where('tickets.category_id', 'like', '%' . Request::input('categoryFilter') . '%');
                });
            })
            ->when(Request::input('statusFilter'), function ($query, $statusFilter) {
                $query->whereHas('tickets', function ($query) {
                    $query->where('tickets.status_id', 'like', '%' . Request::input('statusFilter') . '%');
                });
            })
            ->with('users', 'tickets')
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($ticket) => [
                'id' => $ticket->id,
                'category' => $ticket->tickets->categories->category,
                'reference_number' => $ticket->tickets->reference_number,
                'title' => $ticket->tickets->title,
                'content' => $ticket->tickets->content,
                'user' => $ticket->users->firstName . ' ' . $ticket->users->middleName . ' ' . $ticket->users->lastName,
                'office' => $ticket->users->offices->abbr,
                'status' => $ticket->tickets->statuses->status,
                'created_at' => $ticket->tickets->created_at->toDayDateTimeString(),
                'view_url' => URL::route('ticket.show', $ticket),
                'edit_url' => URL::route('ticket.edit', $ticket)

            ]),
            'filters' => Request::only(['search', 'categoryFilter', 'statusFilter', 'officeFilter']),
            'offices' => Office::all(),
            'categories' => Category::all(),
            'statuses' => Status::all(),
        ]);

        // return Inertia::render('Ticket/Index', [
        //     'tickets' => Ticket::where('user_id', Auth::id())
        //     ->when(Request::input('search'), function ($query, $requestor) {
        //         $query->where('requestor', 'like', "%{$requestor}%")
        //         ->orWhere('reference_number', 'like', "%{$requestor}%");
        //     })
        //     ->when(Request::input('categoryFilter'), function ($query, $category) {
        //         $query->where('category_id', '=', $category);
        //     })
        //     ->when(Request::input('statusFilter'), function ($query, $statusFilter) {
        //         $query->where('status_id', '=', $statusFilter);
        //     })
        //     ->with('users', 'categories', 'statuses')
        //     ->latest()
        //     ->paginate(10)
        //     ->withQueryString()
        //     ->through(fn ($ticket) => [
        //         'id' => $ticket->id,
        //         'category' => $ticket->categories->category,
        //         'reference_number' => $ticket->reference_number,
        //         'title' => $ticket->title,
        //         'content' => $ticket->content,
        //         'user' => $ticket->users->firstName . ' ' . $ticket->users->middleName . ' ' . $ticket->users->lastName,
        //         'office' => $ticket->users->offices->abbr,
        //         'status' => $ticket->statuses->status,
        //         'created_at' => $ticket->created_at->toDayDateTimeString(),
        //         'view_url' => URL::route('ticket.show', $ticket),
        //         'edit_url' => URL::route('ticket.edit', $ticket)

        //     ]),
        //     'filters' => Request::only(['search', 'categoryFilter', 'statusFilter', 'officeFilter']),
        //     'offices' => Office::all(),
        //     'categories' => Category::all(),
        //     'statuses' => Status::all(),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Ticket/Create', [
            'users' => User::where('office_id', Request::input('office_id'))->get(),
            'offices' => Office::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        // Query the category id based on the category id input
        $query = Category::where('id', $request->category_id)->first();
        $input = $query->category;

        // Split the input into an array of words
        $words = explode(' ', $input);

        // Extract the first letter of each word
        $letters = array_map(function ($word) {
            $toUpperCase = ucwords($word);
            return substr($toUpperCase, 0, 1);
        }, $words);

        // Join the array of letters into a single string
        $reference_number = implode('', $letters) . '-' . Auth::id();

        // dd('store is triggered');
        $newTicket = Ticket::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'requestor' => Auth::user()->firstName . ' ' . Auth::user()->middleName . ' ' . Auth::user()->lastName,
            'office_id' => $request->office_id,
            'status_id' => 1
        ]);

        // update reference number
        $updateTicket = Ticket::find($newTicket->id);
        $updateTicket->update([
            'reference_number' => $newTicket->id . '-' . $reference_number
        ]);
        $updateTicket->save();

        // Storing User id & Ticket id
        $userTicket = UserTicket::create([
            'user_id' => Auth::id(),
            'ticket_id' => $newTicket->id
        ]);

        // Activity Store Comment
        $activity = Activity::create([
            'ticket_id' => $newTicket->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $newTicket->user_id,
            'activity_type_id' => 4, // tag type
            'status' => 'unread',
            'comment' => $request->content
        ]);

        return redirect()->route('ticket.create')->with('ticketCreated', 'Ticket created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $userTicket = UserTicket::where('id', $ticket->id)->first();
        $issuer = $userTicket->user_id;
        $dateParse = Carbon::parse($ticket->created_at);
        $res = [
            'id' => $ticket->id,
            'user' => $ticket->requestor,
            'user_id' => $ticket->user_id,
            'issuer' => $issuer,
            'assigned_user' => $ticket->users->firstName . ' ' . $ticket->users->middleName . ' ' . $ticket->users->lastName,
            'assigned_office' => $ticket->users->offices->office,
            'office' => $userTicket->users->offices->office,
            'office_abbr' => $ticket->offices->abbr,
            'reference_number' => $ticket->reference_number,
            'category' => $ticket->categories->category,
            'title' => $ticket->title,
            'content' => $ticket->content,
            'status' => $ticket->statuses->status,
            'remarks' => $ticket->remarks,
            'created_at' => $dateParse->format('Y-m-d H:i:s')
        ];

        $activities = Activity::with('sender', 'receiver', 'tickets', 'activity_types')->where('ticket_id', $ticket->id)->orderBy('created_at', 'desc')->get();
        $currentTime = Carbon::now();

        $mappedActivities = $activities->map(function ($activity) {
            return [
                'user' => $activity->sender->firstName . ' ' . $activity->sender->lastName,
                'imageUrl' => 'https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80',
                'type' => $activity->activity_types->type,
                'comment' => $activity->comment,
                'date' => $activity->created_at->diffForHumans(),
            ];
        });
        // dd($mappedActivities);
        return Inertia::render('Ticket/Show', compact('res', 'mappedActivities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return Inertia::render('Ticket/Edit', [
            'res' => $ticket,
            'categories' => Category::all(),
            'offices' => Office::all(),
            'users' => User::where('office_id', Request::input('office_id'))->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->title = $request->title;
        $ticket->content = $request->content;
        $ticket->category_id = $request->category_id;
        $ticket->save();

        // Updating Reference number

        return back()->with('ticketUpdated', 'Ticket has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return back()->with('ticketDestroyed', 'Ticket has been deleted successfully');
    }

    public function closeTicket(Request $request, $id)
    {
        $status = Request::input('setStatus');
        $query = Ticket::where('id', $id)->first();
        $activitySender = Activity::where('ticket_id', $id)->first();

        if ($status === 'cancel') {
            $query->status_id = 3; //cancel
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
        } else {
            $query->status_id = 4; //complete
            $query->save();

            // Activity Store Comment
            $activity = Activity::create([
                'ticket_id' => $id,
                'sender_id' => Auth::id(),
                // sender should receiver a notification that assigned user closed the request
                'receiver_id' => $activitySender->sender_id,
                'activity_type_id' => 2, // assignment type
                'comment' => 'has successfully closed the ticket.'
            ]);
        }

        if ($status === 'cancel') {
            return back()->with('ticketCancelled', 'Ticket has been cancelled.');
        }
        return back()->with('ticketClosed', 'Ticket has been closed successfully');
    }
}
