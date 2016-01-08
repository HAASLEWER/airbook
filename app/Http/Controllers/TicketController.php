<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
use App\Repositories\TicketRepository;

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
        $this->middleware('auth');

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
        return view('tickets.create');       
    }    

	/**
	 * Create a new Ticket.
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
	        'roundtrip' => 'required|max:255',
	    ]);

	    $request->user()->tickets()->create([
	        'ticketref' => $request->ticketref,
	        'airline' => $request->airline,
	        'dateofdeparture' => $request->dateofdeparture,
	        'origin' => $request->origin,
	        'destination' => $request->destination,
	        'class' => $request->class,
	        'roundtrip' => $request->roundtrip,
	    ]);

	    return redirect('/tickets');
	}    
}
