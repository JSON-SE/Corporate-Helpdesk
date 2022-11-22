<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Office;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'tickets' => Ticket::query()
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
                'view_url' => URL::route('ticket.show', $ticket)
            ]),
            'filters' => Request::only(['search', 'categoryFilter', 'statusFilter', 'officeFilter']),
            'offices' => Office::all(),
            'categories' => Category::all(),
            'statuses' => Status::all(),
        ]);
    }
}
