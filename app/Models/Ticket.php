<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'reference_number', 'title', 'content',  'user_id', 'requestor', 'office_id', 'status_id', 'remarks'
    ];

    public function getDiffForHumans()
    {
        return $this->created_at->diffForHumans();
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offices()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function admin_ticket_management()
    {
        return $this->hasMany(AdminTicketManagement::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
