<?php

namespace App\Repositories;

use App\User;
use App\Credit;
use App\Ticket;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CreditRepository
{
    /**
     * Gets the credit record of a given user if it exists.
     *
     * @param  User  $user
     * @return Boolean
     */
    public function searchUserCreditExists(User $user)
    {
	try {
        	Credit::where('user_id', $user->id)->firstOrFail();
		return true;
	}
	catch(ModelNotFoundException $e) {
		return false;
	}
    }

    /**
     * Gets the number of trade credits for a user
     *
     * @param  User  $user
     * @return Integer
     */
    public function searchUserCreditAmount(User $user)
    {
    	return Credit::where('user_id', $user->id)->first();
    }
}
