@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/tickets/index.css') }}">

@include('common.errors')
<form method="POST" action="{{ url('/tickets') }}">
    {!! csrf_field() !!}
    <div class="card search-card">
        <div class="card-content">
            <div class="row">
                <div class="input-field col s4">
                  <input id="airline" type="text" class="validate" name="airline">
                  <label for="airline">Airline</label>
                </div>
                <div class="input-field col s4">
                  <input id="dateofdeparture" type="text" class="validate" name="dateofdeparture">
                  <label for="dateofdeparture">Date</label>
                </div>    
                <div class="input-field col s4">
                  <input id="origin" type="text" class="validate" name="origin">
                  <label for="origin">Origin</label>
                </div>
            </div>   
            <div class="row">
                <div class="input-field col s4">
                  <input id="destination" type="text" class="validate" name="destination">
                  <label for="destination">Destination</label>
                </div>
                <div class="input-field col s4">
                  <input id="class" type="text" class="validate" name="class">
                  <label for="class">Class</label>
                </div>  
                <div class="input-field col s4">
                  <input id="roundtrip" type="text" class="validate" name="roundtrip">
                  <label for="roundtrip">Return Trip</label>
                </div>      
            </div>                        

            <button class="btn waves-effect waves-light" type="submit" name="action">Search
              <i class="material-icons right">send</i>
            </button>   
        </div>
    </div>
</form>
            

<div class="row">
    @if (count($tickets) > 0)
        @foreach ($tickets as $ticket)
            <div class="col m6 s12 l3">
                <div class="card hoverable ticket-card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/ticket.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">{{ $ticket->origin }} - {{ $ticket->destination }}<i class="material-icons right">more_vert</i></span>
                        <p><a href="#">This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{ $ticket->origin }} - {{ $ticket->destination }}<i class="material-icons right">close</i></span>
                        <div>{{ $ticket->ticketref }}</div>
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

@endsection