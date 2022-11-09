<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'category_id', 'office_id', 'user_id', 'status_id', 'remarks'
    ];
}
