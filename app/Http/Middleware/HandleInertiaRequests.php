<?php
namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\Activity;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        $notificationCounter = Activity::with('tickets', 'sender', 'receiver')
        // ->whereHas('tickets', function ($query) {
        //     $query->where('user_id', Auth::id());
        // })
        ->where('receiver_id', Auth::id())
        ->where('status', 'unread')
        ->count();
        $notifications = Activity::with('tickets', 'sender', 'receiver')
        ->where('receiver_id', Auth::id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->get();
        // dd($notifications);
        $userNotificationId = Activity::where('receiver_id', Auth::id())->first();
        // dd($userNotificationId);
        $filteredNotifications = $notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'sender_id' => $notification->sender_id,
                'receiver_id' => $notification->receiver_id,
                'sender_name' => $notification->sender->firstName . ' ' . $notification->sender->middleName . ' ' . $notification->sender->lastName,
                'ticket_id' => $notification->ticket_id,
                'reference_number' => $notification->tickets->reference_number,
                'type' => $notification->activity_type_id,
                'status' => $notification->status,
                'comment' => $notification->comment,
                'date' => $notification->created_at->diffForHumans()
            ];
        });

        // dd($filteredNotifications);

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'ticketCreated' => session('ticketCreated'),
                'ticketUpdated' => session('ticketUpdated'),
                'ticketCancelled' => session('ticketCancelled'),
                'ticketClosed' => session('ticketClosed'),
                'ticketDestroyed' => session('ticketDestroyed'),
                'ticketAccepted' => session('ticketAccepted'),
                'commentPosted' => session('commentPosted'),
                'registered' => session('registered'),
                'loggedIn' => session('loggedIn')
            ],
            'notification_counter' => $notificationCounter,
            'notifications' => $filteredNotifications,
            'userNotificationId' => $userNotificationId,
            'user.roles' => $request->user() ? $request->user()->roles->pluck('name') : [],
            'user.permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : []
        ]);
    }
}
