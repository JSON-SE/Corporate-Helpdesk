<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminTicketManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('ticket', TicketController::class);
    Route::put('ticket/close/{id}', [TicketController::class, 'closeTicket'])->name('ticket.close');
    Route::inertia('management/index', 'Management/Index')->name('management.index');
    Route::resource('admin-ticket-management', AdminTicketManagementController::class);
    Route::post('admin-ticket-management/accept/{id}', [AdminTicketManagementController::class, 'accept'])->name('admin-ticket-management.accept');
    Route::put('admin-ticket-management/decline/{id}', [AdminTicketManagementController::class, 'decline'])->name('admin-ticket-management.decline');
    Route::resource('task', AdminTicketManagementController::class);
    // Route::get('task/accomplishment', [AdminTicketManagementController::class, 'accomplishment'])->name('task.accomplishment');
    Route::post('comment/store/{id}', [ActivityController::class, 'store'])->name('comment.store');
    Route::put('notified/{id}', [ActivityController::class, 'notified'])->name('notified.close');
    Route::put('notified/clearall/{id}', [ActivityController::class, 'notifiedClearAll'])->name('notified.clearall');
    Route::get('show/ticket/{id}', [ActivityController::class, 'show'])->name('show.ticket');
});

require __DIR__ . '/auth.php';
