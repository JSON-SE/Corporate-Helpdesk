<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];

    public function tickets()
    {
        return $this->hasOne(Ticket::class);
    }

    public function admin_ticket_management()
    {
        return $this->hasMany(AdminTicketManagement::class);
    }
}
