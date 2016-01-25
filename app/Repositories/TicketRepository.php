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
	$where["user_id"] = $user->id;
	$where["valid"] = '1';

        return Ticket::where($where)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all of the tickets for a given user that the user has acquired through use of credits.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUserAcquired(User $user)
    {
        $where["user_id"] = $user->id;
        $where["valid"] = '1';
	$where["tradable"] = '0';

        return Ticket::where($where)
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
	$where["valid"] = '1';
        $where["tradable"] = '1';

        return Ticket::where($where)
		    ->orderBy('created_at', 'asc')
		    ->get();
    } 

    /**
     * Search tickets.
     *
     * @param  Ticket  $ticket     
     * @return Collection
     */
    public function searchTickets($req)
    {
	    $where["valid"] = '1';

        unset($req["_token"]);

        if(isset($req['dateofdeparture'])) {
            $depDate = $req['dateofdeparture'];
            unset($req['dateofdeparture']);
        }

        foreach ($req as $key => $value) {
            if (empty($value)) {
                unset($req[$key]);
            } else {
                $where[$key] = $value; 
            }
        }

        if(isset($where['roundtrip'])) {
            if($where['roundtrip'] == 'on') {
                $where['roundtrip'] = '1';
            } else {
                $where['roundtrip'] = '0';
            }
        }
        if(isset($depDate)) {
            return Ticket::where($where)
                ->whereBetween('dateofdeparture', [$depDate." 00:00:01", $depDate." 23:59:59"])
                ->orderBy('created_at', 'asc')
                ->get(); 
        } else {
            return Ticket::where($where)
                ->orderBy('created_at', 'asc')
                ->get();        
        }
        
    }         

    /**
     * Search User specific tickets.
     *
     * @param  Ticket  $ticket     
     * @return Collection
     */
    public function searchUserTickets($req, User $user)
    {
	$where["user_id"] = $user->id;
	$where["valid"] = '1';
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
     * Search User specific tickets that have been acquired using a credit trade.
     *
     * @param  Ticket  $ticket     
     * @return Collection
     */
    public function searchUserTicketsAcquired($req, User $user)
    {
        $where["user_id"] = $user->id;
        $where["valid"] = '1';
	$where["tradable"] = '0';

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
}
