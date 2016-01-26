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

    /**
     * Determine the values of a tickets class
     *
     * @param  Array $ticketDetails
     * @return interger
     */
     public function ticketValues($classValue) {
         //Determine the credit value on the class of the submitted ticket
         switch ($classValue) {
         	case 'Economy':
                	return 1;
                        break;
                case 'Business':
                        return 2;
                        break;
		case 'First':
                        return 3;
                        break;
                case 'Premium':
                        return 4;
                        break;
                default:
                        return 1;
                        break;
         }
      }
}
