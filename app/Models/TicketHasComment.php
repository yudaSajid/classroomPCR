<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketHasComment extends Model
{
    protected $fillable = [
        'comment',
        'ticket_id',
        'user_id',
    ];

    // Relasi dengan Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
