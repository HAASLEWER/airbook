<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CreditRepository;

use Auth;

class CreditController extends Controller
{
    /**
     * The credit repository instance.
     *
     * @var CreditRepository
     */
    protected $credits;

    /**
     * Create a new controller instance.
     *
     * @param  CreditRepository  $credits
     * @return void
     */
    public function __construct(CreditRepository $credits)
    {
        $this->credits = $credits;
    }

    /**
     * Check if a user has a credit record in the database.
     *
     * @param  None
     * @return Boolean
     */
    public function creditRecordExists() {
	 try {
             $this->credits->searchUserCreditExists(Auth::user());
	     return true;
	 }
	 catch(Exception $e) {
	     return false;
	 }
    }

    /**
     * Create a new credit record for a user. This record will be used for all future credit control actions.
     *
     * @param  None
     * @return Boolean
     */
    public function userCreditRecordCreate() {
	
    }
}
