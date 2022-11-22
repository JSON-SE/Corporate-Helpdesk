<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Office;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    public function index()
    {
        return Inertia::render('Ticket/Index', [
            'tickets' => Ticket::where('user_id', Auth::id())
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('reference_number', 'like', "%{$search}%");
            })
            ->when(Request::input('categoryFilter'), function ($query, $category) {
                $query->where('category_id', '=', $category);
            })
            ->when(Request::input('statusFilter'), function ($query, $statusFilter) {
                $query->where('status_id', '=', $statusFilter);
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
                'user' => $ticket->users->firstName . ' ' . $ticket->users->middleName . ' ' . $ticket->users->lastName,
                'office' => $ticket->users->offices->abbr,
                'status' => $ticket->statuses->status,
                'created_at' => $ticket->created_at->diffForHumans()
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
        // $user = Auth::user();
        $categories = Category::all();
        return Inertia::render('Ticket/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        // dd('store is triggered');
        $newTicket = Ticket::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'office_id' => auth()->user()->office_id,
            'status_id' => 1
        ]);
        // Updating Reference number
        if ($request->category_id == 1) {
            $storeRefId = Ticket::find($newTicket->id);
            $storeRefId->reference_number = 'HW' . '-' . $newTicket->id;
            $storeRefId->save();
        } elseif ($request->category_id == 2) {
            $storeRefId = Ticket::find($newTicket->id);
            $storeRefId->reference_number = 'SW' . '-' . $newTicket->id;
            $storeRefId->save();
        } elseif ($request->category_id == 3) {
            $storeRefId = Ticket::find($newTicket->id);
            $storeRefId->reference_number = 'IR' . '-' . $newTicket->id;
            $storeRefId->save();
        } elseif ($request->category_id == 4) {
            $storeRefId = Ticket::find($newTicket->id);
            $storeRefId->reference_number = 'ET' . '-' . $newTicket->id;
            $storeRefId->save();
        } else {
            $storeRefId = Ticket::find($newTicket->id);
            $storeRefId->reference_number = 'OT' . '-' . $newTicket->id;
            $storeRefId->save();
        }

        return redirect()->route('ticket.create')->with('message', 'Ticket created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
