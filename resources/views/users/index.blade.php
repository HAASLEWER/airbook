@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/tickets/index.css') }}">

<div class="card">
        <div class="card-content">
		<h3>My Tickets</h3>
			<div class="row">
    				@if (count($tickets) > 0)
        				@foreach ($tickets as $ticket)
            					<div class="col m6 s12 l3">
                					<div class="card hoverable ticket-card">
                    						<div class="card-image waves-effect waves-block waves-light">
                        						<img class="activator" src="{{ URL::asset('img/ticket.jpg') }}">
                    						</div>
                    						<div class="card-content">
                        						<span class="card-title activator grey-text text-darken-4">{{ $ticket->origin }} - {{ $ticket->destination }}<i class="material-icons right">more_vert</i></span>
                        						<p><a href="#">This is a link</a></p>
                    						</div>
                    						<div class="card-reveal">
                        						<span class="card-title grey-text text-darken-4">{{ $ticket->origin }} - {{ $ticket->destination }}<i class="material-icons right">close</i></span>
                        						<div>{{ $ticket->airline }}</div>
                       							<div>{{ $ticket->dateofdeparture }}</div>
                        						<div>{{ $ticket->class }}</div>
                        						<div>{{ $ticket->origin }}</div>
                        						<div>{{ $ticket->destination }}</div>
                        						<div>{{ $ticket->roundtrip }}</div>
                    						</div>
                					</div>
            					</div>    
        				@endforeach
    				@endif
			</div>
	</div>
</div>
@endsection
