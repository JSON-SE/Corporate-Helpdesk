<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Office;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function weeklyTicketCount()
    {
        // Retrieve the current week's ticket count
        $current_weekly_count = Ticket::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // Retrieve the previous week's ticket count
        $previous_weekly_count = Ticket::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->count();

        // Calculate the percentage change in ticket count between the two weeks
        if ($previous_weekly_count > 0) {
            $percentage_change = ($current_weekly_count - $previous_weekly_count) / $previous_weekly_count * 100;
        } else {
            $percentage_change = 0;
        }

        // Retrieve the total number of tickets created
        $total_ticket_count = Ticket::count();

        // Return if the generated ticket has increase or decrease status
        if ($current_weekly_count > $previous_weekly_count) {
            $changeType = 'increase';
        } else {
            $changeType = 'decrease';
        }

        // Return the current weekly count, percentage change, and total ticket count
        return [
            'name' => 'Weekly Generated Tickets',
            'sub_name' => "Previous weeks's total count",
            'stat' => $current_weekly_count,
            'previousStat' => $previous_weekly_count,
            'change' => $percentage_change,
            'changeType' => $changeType
        ];
    }

    public function monthlyTicketCount()
    {
        // Retrieve the current month's ticket count
        $current_monthly_count = Ticket::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        // Retrieve the previous month's ticket count
        $previous_monthly_count = Ticket::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->count();

        // Calculate the percentage change in ticket count between the two months
        if ($previous_monthly_count > 0) {
            $percentage_change = ($current_monthly_count - $previous_monthly_count) / $previous_monthly_count * 100;
        } else {
            $percentage_change = 0;
        }

        // Retrieve the total number of tickets created
        $total_ticket_count = Ticket::count();

        // Return if the generated ticket has increase or decrease status
        if ($current_monthly_count > $previous_monthly_count) {
            $changeType = 'increase';
        } else {
            $changeType = 'decrease';
        }

        // Return the current weekly count, percentage change, and total ticket count
        return [
            'name' => 'Monthly Generated Tickets',
            'sub_name' => "Previous month's total count",
            'stat' => $current_monthly_count,
            'previousStat' => $previous_monthly_count,
            'change' => $percentage_change,
            'changeType' => $changeType
        ];
    }

    public function yearlyTicketCount()
    {
        // Retrieve the current year's ticket count
        $current_yearly_count = Ticket::whereYear('created_at', Carbon::now()->year)->count();

        // Retrieve the ticket count for the past number of months
        $previous_yearly_count = Ticket::whereYear('created_at', Carbon::now()->year)
                                                ->whereMonth('created_at', '<', Carbon::now()->month)
                                                ->count();

        // Calculate the percentage change in ticket count between the two time periods
        if ($previous_yearly_count > 0) {
            $percentage_change = ($current_yearly_count - $previous_yearly_count) / $previous_yearly_count * 100;
        } else {
            $percentage_change = 0;
        }

        // Retrieve the total number of tickets created
        $total_ticket_count = Ticket::count();

        // Return if the generated ticket has increase or decrease status
        if ($current_yearly_count > $previous_yearly_count) {
            $changeType = 'increase';
        } else {
            $changeType = 'decrease';
        }

        // Return the current weekly count, percentage change, and total ticket count
        return [
            'name' => 'Yearly Generated Tickets',
            'sub_name' => 'From the previous months total count',
            'stat' => $current_yearly_count,
            'previousStat' => $previous_yearly_count,
            'change' => $percentage_change,
            'changeType' => $changeType
        ];
    }

    public function index()
    {
        $weeklyTicketCount = DashboardController::weeklyTicketCount();
        $monthlyTicketCount = DashboardController::monthlyTicketCount();
        $yearlyTicketCount = DashboardController::yearlyTicketCount();
        $ticketCount = [
            $weeklyTicketCount,
            $monthlyTicketCount,
            $yearlyTicketCount
        ];

        return Inertia::render('Dashboard', [
            'ticket_counter' => $ticketCount,
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
                'view_url' => URL::route('ticket.show', $ticket),
                'destroy_url' => URL::route('ticket.destroy', $ticket)
            ]),
            'filters' => Request::only(['search', 'categoryFilter', 'statusFilter', 'officeFilter']),
            'offices' => Office::all(),
            'categories' => Category::all(),
            'statuses' => Status::all(),
        ]);
    }
}
