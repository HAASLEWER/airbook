<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticketref', 'airline', 'dateofdeparture', 'class', 'origin', 'destination', 'roundtrip'];

    /**
     * Get the user that owns the ticket
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
}
