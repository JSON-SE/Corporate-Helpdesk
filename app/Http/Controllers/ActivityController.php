<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Ticket;
use App\Models\Activity;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends Controller
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
     * @param  \App\Http\Requests\StoreActivityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityRequest $request)
    {
        $ticket = Ticket::where('id', $request->id)->first();
        $activitySender = Activity::where('ticket_id', $request->id)->first();
        if ($ticket->user_id === Auth::id()) {
        //    assigned user is commenting ...
            $newActivity = Activity::create([
                'ticket_id' => $request->id,
                'sender_id' => Auth::id(),
                // sender should receiver a comment notification
                'receiver_id' => $activitySender->sender_id,
                'activity_type_id' => 1, // comment
                'comment' => $request->comment
            ]);
            return back()->with('commentPosted', 'Comment has been posted');
        } else {
            // issuer is commenting
            $newActivity = Activity::create([
                'ticket_id' => $request->id,
                'sender_id' => Auth::id(),
                // sender should receiver a comment notification
                'receiver_id' => $ticket->user_id,
                'activity_type_id' => 1, // comment
                'comment' => $request->comment
            ]);
            return back()->with('commentPosted', 'Comment has been posted');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, $id)
    {
        $activity = Activity::where('id', $id)->first();
        $ticketId = $activity->ticket_id;
        $ticket = Ticket::where('id', $ticketId)->first();
        $userTicket = UserTicket::where('id', $ticketId)->first();
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
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityRequest  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }

    public function notified(Request $request, $id)
    {
        $activity = Activity::where('id', $id)->first();
        $activity->status = 'read';
        $activity->save();

        return back();
    }

    public function notifiedClearAll(Request $request, $id)
    {
        $query = Activity::where('receiver_id', $id)->where('status', 'unread')->get();
        foreach ($query as $item) {
            // update all item to read where status is unread
            $item->status = 'read';
            $item->save();
        }

        return back();
    }
}
