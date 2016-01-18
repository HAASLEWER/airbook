<?php

namespace App\Repositories;

use App\User;
use App\Ticket;

class TicketRepository
{
    /**
     * Get all of the tickets for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Ticket::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all of the tickets.
     *
     * @return Collection
     */
    public function allTickets()
    {
        return Ticket::orderBy('created_at', 'asc')->get();
    } 

    /**
     * Search tickets.
     *
     * @param  Ticket  $ticket     
     * @return Collection
     */
    public function searchTickets($req)
    {
        $where = [];
        unset($req["_token"]);

        foreach ($req as $key => $value) {
            if (empty($value)) {
                unset($req[$key]);
            } else {
                $where[$key] = $value; 
            }
        }

        return Ticket::where($where)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }         

    /**
     * Search User specific tickets.
     *
     * @param  Ticket  $ticket     
     * @return Collection
     */
    public function searchUserTickets($req, User $user)
    {
        $where = [];
        unset($req["_token"]);

        foreach ($req as $key => $value) {
            if (empty($value)) {
                unset($req[$key]);
            } else {
                $where[$key] = $value;
            }
        }

	//Append user_id to where condition to return only that users tickets
	$where["user_id"] = $user->id;

        return Ticket::where($where)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
