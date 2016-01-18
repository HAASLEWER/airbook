<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
use App\Repositories\TicketRepository;

use Auth;

use Goutte\Client;

class TicketController extends Controller
{
    /**
     * The ticket repository instance.
     *
     * @var TicketRepository
     */
    protected $tickets;

    /**
     * Create a new controller instance.
     *
     * @param  TicketRepository  $tickets
     * @return void
     */
    public function __construct(TicketRepository $tickets)
    {
        $this->tickets = $tickets;
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
    public function userTickets(Request $request) {
        return view('users.index', [
            'tickets' => $this->tickets->forUser(Auth::user()),
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
	    $this->validate($request, [
                        'ticketref' => 'required|max:255',
                        'airline' => 'required|max:255',
                        'dateofdeparture' => 'required|max:255',
                        'origin' => 'required|max:255',
                        'destination' => 'required|max:255',
                        'class' => 'required|max:255',
            ]);

	    $validatedTicket = $this->verifyTicket($request->all());
	
	    if ($validatedTicket == true) {

	    	$request->user()->tickets()->create([
	        	'ticketref' => $request->ticketref,
	        	'airline' => $request->airline,
	        	'dateofdeparture' => $request->dateofdeparture,
	        	'origin' => $request->origin,
	        	'destination' => $request->destination,
	        	'class' => $request->class,
	        	'roundtrip' => $request->roundtrip,
	    	]);

	    	return redirect('/tickets/profile');

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
				//$validTicket = $this->verifyKulula($ticketDetails);
				echo 'kulula';
				break;
			case 'Mango':
                                echo 'Mango';
				break;
			case 'Safair':
				$validTicket = $this->verifySafair($ticketDetails);
				break;
			default:
				$validTicket = $this->verifySouthAfricanAirways($ticketDetails);
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

		$form = $crawler->selectButton('LOGIN')->form();
		$form['pnrCode'] = $ticketDetails['ticketref'];
		$form['surName'] = Auth::user()->lastname;
		$form['windowResLogin'] = '';
		$form['abmjasa'] = 'SEARCH';

		$crawler = $client->submit($form);

		if (strpos($crawler->text(),'Your reservation number could not be found') == false) {
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
                $crawler = $client->request('GET', 'https://www.flysafair.co.za/manage/Manage-booking');

                $form = $crawler->selectButton('Retrieve booking')->form();
                $form['PNR'] = $ticketDetails['ticketref'];
                $form['lastName'] = Auth::user()->lastname;

                $crawler = $client->submit($form);

                if (strpos($crawler->text(),'
                    Your booking could not be found. Please check the spelling and try again.
                ') === false) {
                        return false;
                } else {
                        return true;
                }
        }

	 /**
	* NOT YET WORKING!!!!
        * Validates a Kulula ticket via web scraper
        *
        * @param array $ticketDetails
        * @return Boolean
        
        protected function verifyKulula($ticketDetails) {

                $client = new Client();
                $crawler = $client->request('GET', 'https://flights.kulula.com/SSW2010/E6IE/myb.html#_ga=', 
					['headers' => [
						'User-Agent' => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36"
						]
					]);

                $form = $crawler->selectButton('view / change flight')->form();
                $form['bookingretrieval-reservationCode'] = $ticketDetails['ticketref'];
                $form['bookingretrieval-lastName'] = Auth::user()->lastname;

                $crawler = $client->submit($form);

                if (strpos($crawler->text(),'Booking not found') == false) {
                        return false;
                } else {
                        return true;
                }
        }*/
}
