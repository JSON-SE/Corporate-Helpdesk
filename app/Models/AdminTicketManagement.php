<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminTicketManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'status_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tickets()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
