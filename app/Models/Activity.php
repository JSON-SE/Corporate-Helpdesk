<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'activity_type_id',
        'statuås',
        'comment'
    ];

    public function tickets()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activity_types()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }
}
