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
        $tickets = Ticket::with('users.offices', 'statuses', 'categories')->get();
        return Inertia::render('Dashboard', compact('tickets', 'categories', 'offices', 'statuses'));
    }
}
