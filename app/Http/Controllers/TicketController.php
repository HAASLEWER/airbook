<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
use App\Credit;

use App\Repositories\TicketRepository;
use App\Repositories\CreditRepository;

use Auth;
use DB;

use Goutte\Client;

class TicketController extends Controller
{
    /**
     * Repository instances.
     *
     * @var TicketRepository CreditRepository
     */
    protected $tickets;
    protected $credits;

    /**
     * Create a new controller instance.
     *
     * @param  TicketRepository  $tickets
     * @return void
     */
    public function __construct(TicketRepository $tickets, CreditRepository $credits)
    {
        $this->tickets = $tickets;
	$this->credits = $credits;
    }

    /**
     * Display a list of all Tickets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request) {
        return view('tickets.index', [
            'tickets' => $this->tickets->allTickets(),
        ]);       
    }

    /**
     * Display a list of a Users Tiackets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function userProfile(Request $request) {
        return view('users.index', [
            'tickets' => $this->tickets->forUserAcquired(Auth::user()),
	    'credits' => $this->credits->searchUserCreditAmount(Auth::user())
        ]);
    }

    /**
     * Search for tickets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function search(Request $request) {   	
        return view('tickets.index', [
            'tickets' => $this->tickets->searchTickets($request->all()),
        ]);       
    }    

    /**
     * Search for user specific tickets.
     *
     * @param  Request  $request
     * @return Response
     */
    public function userSearch(Request $request) {
        return view('users.index', [
            'tickets' => $this->tickets->searchUserTicketsAcquired($request->all(), Auth::user()),
	    'credits' => $this->credits->searchUserCreditAmount(Auth::user())
        ]);
    }

    /**
     * Display the create ticket form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request) {
	if (Auth::check()) {
        	return view('tickets.create');
	} else {
		return view('auth.login');       
	}
    }    

	/**
	 * Create a new Ticket while ticket is valid.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{

        if($request->roundtrip == 'on') {
            $request->roundtrip = '1';

	    //Validate existance but more importantly, return dates cannot be before departure dates... not to obothered with same day returns for now...
	    $this->validate($request, ['dateofreturn' => 'required|date|after:'.$request->dateofdeparture, 'timeofreturn' => 'required|max:255']);
	
	    $dateAndTimeReturn = $request->dateofreturn . ' ' . $request->timeofreturn;

        } else {
            $request->roundtrip = '0';

	    $dateAndTimeReturn = "0000-00-00 00:00:00";
        }

        $dateAndTime = $request->dateofdeparture . ' ' . $request->timeofdeparture;

	    $this->validate($request, [
                        'ticketref' => 'required|max:255',
                        'airline' => 'required|max:255',
                        'dateofdeparture' => 'required|max:255',
			'timeofdeparture' => 'required|max:255',
                        'origin' => 'required|max:255',
                        'destination' => 'required|max:255',
                        'class' => 'required|max:255',
            ]);

	    $validatedTicket = $this->verifyTicket($request->all());
	
	    if ($validatedTicket == true) {

		//Create the ticket record...
	    	$request->user()->tickets()->create([
	        	'ticketref' => $request->ticketref,
	        	'airline' => $request->airline,
	        	'dateofdeparture' => $dateAndTime,
	        	'origin' => $request->origin,
	        	'destination' => $request->destination,
	        	'class' => $request->class,
	        	'roundtrip' => $request->roundtrip,
			'dateofreturn' => $dateAndTimeReturn,
			'valid' => '1',
			'tradable' => '1',
	    	]);

		//Call ticketValues to determine how to increment
		$ticketValue = $this->credits->ticketValues($request->class);		

		//Uses the credits repository to check if the user has a credit record, if not, creates it with a credit or increments and existing credit record trade value.
		if ($this->credits->searchUserCreditExists(Auth::user()) == true) {
			DB::table('credits')
				->where('user_id', Auth::user()->id)
				->increment('trade', $ticketValue);
		} else {
			$request->user()->credits()->create([
                                'trade' => $ticketValue,
                        ]);
		}
		
	    	return redirect('/tickets');

	    } else {

		$request->session()->flash('status', 'Ticket could not be verified with the airline! Please try again.');
		return redirect('/tickets/create');
	    }
	}    

	/**
	* Determines which airline to verify and then calls an appropriate airline scraper method
	* 
	* @param array $ticketDetails
	* @return Boolean 
	*/
	protected function verifyTicket($ticketDetails) {

		switch ($ticketDetails['airline']) {
			case 'South African Airways':
				$validTicket = $this->verifySouthAfricanAirways($ticketDetails);
				break;
			case 'Kulula':
				$validTicket = $this->verifyKulula($ticketDetails);
				break;
			case 'Mango':
                		$validTicket = $this->verifyMango($ticketDetails);
				break;
			case 'Safair':
				$validTicket = $this->verifySafair($ticketDetails);
				break;
			case 'British Airways':
				$validTicket = $this->verifyBritishAirways($ticketDetails);
				break;
			default:
				$validTicket = $this->verifySouthAfricanAirways($ticketDetails);
				break;
		}

		//Boolean representation of valid or invalid ticket
		return $validTicket;
	}

	/**
	* Validates an SAA ticket via web scraper
	*
	* @param array $ticketDetails
	* @return Boolean
	*/
	protected function verifySouthAfricanAirways($ticketDetails) {

		$client = new Client();
		$crawler = $client->request('GET', 'https://www.flysaa.com/za/en/searchpnr.secured?loc=za&lan=en');

		$form = $crawler->selectButton('Login')->form();
		$form['pnrCode'] = $ticketDetails['ticketref'];
		$form['surName'] = Auth::user()->lastname;
		$form['windowResLogin'] = '';
		$form['abmjasa'] = 'SEARCH';

		$crawler = $client->submit($form);

		if (!strpos($crawler->text(),"You are logged in as")) {
			return false;
		} else {
			return true;
		}
	}
	
     /**
    * 
    * Validates a Kulula ticket via web scraper
    *
    * @param array $ticketDetails
    * @return Boolean
    */     
    protected function verifyKulula($ticketDetails) {

        $shell_string = '../vendor/bin/phantomjs ../resources/assets/js/kulula.js '.$ticketDetails['ticketref'].' '.Auth::user()->lastname;
        $output = shell_exec($shell_string);
        
        if (substr($output, -2, 1) == '1') {
                return false;
        } else {
                return true;
        }
    }

    /**
    * 
    * Validates a British Airways ticket via web scraper
    *
    * @param array $ticketDetails
    * @return Boolean
    */
    protected function verifyBritishAirways($ticketDetails) {

        $shell_string = '../vendor/bin/phantomjs ../resources/assets/js/britishairways.js '.$ticketDetails['ticketref'].' '.Auth::user()->lastname;
        $output = shell_exec($shell_string);

        if (substr($output, -2, 1) == '1') {
                return false;
        } else {
                return true;
        }
    }

    /**
    * Validates a Mango ticket via web scraper
    *
    * @param array $ticketDetails
    * @return Boolean
    */
    protected function verifyMango($ticketDetails) {

        $client = new Client();
        $crawler = $client->request('GET', 'https://www.flymango.com/en/manage-travel/check-and-change/view-booking');

        //Get User DOB
        $id = Auth::user()->idnumber;

        //Calculate Century
        $currentYear = date("y");
        $birthYear = substr($id, 0, 2);
        if($birthYear > $currentYear) {
            $formYear = '19'.$birthYear;
        } else {
            $formYear = '20'.$birthYear;
        }

        $form = $crawler->selectButton('Login')->form();

        $form['bookingNumber'] = $ticketDetails['ticketref'];
        $form['birthDay'] = substr($id, 4, 2);
        $form['birthMonth'] = substr($id, 2, 2);
        $form['birthYear'] = $formYear;

        $crawler = $client->submit($form);

        if (!strpos($crawler->text(),"Couldn\'t find the specified booking.")) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
    * Validates an Safair ticket via web scraper
    *
    * @param array $ticketDetails
    * @return Boolean
    */
    protected function verifySafair($ticketDetails) {

            $client = new Client();

	    //Do not verify SSL for this host as we get SSL errors...
	    $guzzleClient = new \GuzzleHttp\Client(array(
    			'curl' => array(
        			CURLOPT_SSL_VERIFYPEER => false,
    				),
			));

	    $client->setClient($guzzleClient);

            $crawler = $client->request('GET', 'https://www.flysafair.co.za/manage/Manage-booking');


            $form = $crawler->selectButton('Retrieve booking')->form();
            $form['PNR'] = $ticketDetails['ticketref'];
            $form['lastName'] = Auth::user()->lastname;

            $crawler = $client->submit($form);

            if (!strpos($crawler->text(),"
                    Your booking could not be found. Please check the spelling and try again.
                ")) {
                    return false;
            } else {
                    return true;
            }
    }

    /**
    * Changes the user ownership of a ticket and marks it untradable at the cost of a user credit
    *
    * @param array $ticketDetails
    * @return Boolean
    */
    protected function tradeTicket(Request $request) {
    
    //Prevent users from trading there own tickets... 
    if (Auth::user()->id != $request->user_id) {

	//Check if the user making the trade even has a credit record and if so then count the users available credits...
	if ($this->credits->searchUserCreditExists(Auth::user()) == true) {

		$creditRecord = $this->credits->searchUserCreditAmount(Auth::user());

		//Call ticketValues to determine how to increment
		$class = DB::table('tickets')->where('id', $request->id)->first();
		$value = $this->credits->ticketValues($class->class);

		if ($creditRecord->trade >= $value) {
			//User has credits so we can decrement one for this trade
                        DB::table('credits')
                                ->where('user_id', Auth::user()->id)
                                ->decrement('trade', $value);

			//Change the user_id of the ticket
			DB::table('tickets')
				->where('id', $request->id)
				->update(array('user_id' => Auth::user()->id,
					 'tradable' => 0));

			return redirect('/profile');
		} else {
			$request->session()->flash('status', 'Ticket could not be traded! Not enough Credits!');
                	return redirect('/profile');
		}
        } else {
		$request->session()->flash('status', 'Ticket could not be traded! Not enough Credits! To gain a credit, submit a valid ticket.');
                return redirect('/profile');
        }
    } else {
	$request->session()->flash('status', 'Ticket could not be traded! You cannot reclaim a ticket that you submitted!');
                return redirect('/profile');
    }
    }
}
