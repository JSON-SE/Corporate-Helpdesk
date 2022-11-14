<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return Inertia::render('Dashboard', compact('tickets'));
    }
}
