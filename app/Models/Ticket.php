<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assigned_to',
        'title',
        'description',
        'status'
    ];

    protected $casts = [
        'resolved_at' => 'datetime'
    ];

    public function user()  // creator
    {
        return $this->belongsTo(User::class);
    }

    public function assignedSupport()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}

