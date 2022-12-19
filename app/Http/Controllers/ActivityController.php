<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Activity;
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
        // BUG in the code. receiver id must be fixed based on whos commenting.
        /**
         * FIXME:
         * 1. BUG in the code. receiver id must be fixed based on whos commenting.
         * TODO:
         * 1. create a query where auth id is equal to ticket sender id? then use acitivty sender id ????? not sure
         *
        */
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
    public function show(Activity $activity)
    {
        //
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
}
