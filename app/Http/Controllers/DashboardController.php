<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Office;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        $categories = Category::all();
        $statuses = Status::all();
        $tickets = Ticket::latest()->paginate(10)->through(fn ($ticket) => [
            'id' => $ticket->id,
            'category' => $ticket->categories->category,
            'title' => $ticket->title,
            'content' => $ticket->content,
            'user' => $ticket->users->firstName . ' ' . $ticket->users->middleName . ' ' . $ticket->users->lastName,
            'office' => $ticket->users->offices->abbr,
            'status' => $ticket->statuses->status,
            'created_at' => $ticket->created_at->diffForHumans()
        ]);
        // dd($tickets);
        return Inertia::render('Dashboard', compact('tickets', 'categories', 'offices', 'statuses'));
    }
}
