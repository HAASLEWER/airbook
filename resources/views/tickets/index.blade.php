@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/tickets/index.css') }}">

<form method="POST" action="{{ url('/tickets') }}">
    {!! csrf_field() !!}
    <div class="card search-card">
        <div class="card-content">
	    <h3>Tradable Tickets</h3>

	    <!-- Display Validation Errors -->
        	<div class="row red darken-4">
                <span class="white-text">@include('common.errors')</span>
                @if(Session::has('status'))
                        <b class="white-text">Something went wrong!</b>
                        <br/><br/>
                        <span class="white-text">{{ Session::get('status') }}</span>
                        <br/><br/>
                @endif
        	</div>

            <div class="row">
                <div class="input-field col s4">
                    <select  id="airline" class="validate">
                      <option value="" disabled selected>Select Airline</option>
                      <option value="1">South African Airways</option>
                      <option value="2">Kulula</option>
                      <option value="3">Mango</option>
                      <option value="3">Safair</option>
		                  <option value="4">British Airways</option>
                    </select>
                    <label>Airline</label>
                </div>
                <div class="input-field col s4">
                  <input id="dateofdeparture" type="text" class="datepicker" name="dateofdeparture">
                  <label for="dateofdeparture">Date</label>
                </div>    
                <div class="input-field col s4">
                    <select  id="origin" class="validate">
                      <option value="" disabled selected>Select Origin</option>
                      <option value="1">JNB</option>
                      <option value="2">BFN</option>
                      <option value="3">CPT</option>
                      <option value="3">DBN</option>
                    </select>
                    <label>Origin</label>
                </div>
            </div>   
            <div class="row">
                <div class="input-field col s4">
                    <select  id="destination" class="validate">
                      <option value="" disabled selected>Select Destination</option>
                      <option value="1">JNB</option>
                      <option value="2">BFN</option>
                      <option value="3">CPT</option>
                      <option value="3">DBN</option>
                    </select>
                    <label>Destination</label>
                </div>
                <div class="input-field col s4">
                    <select  id="class" class="validate">
                      <option value="" disabled selected>Select Class</option>
                      <option value="1">Economy</option>
                      <option value="2">Business</option>
                      <option value="3">First</option>
                      <option value="3">Premium</option>
                    </select>
                    <label>Class</label>
                </div>
                <div class="input-field col s4">
                  <input id="roundtrip" type="checkbox" class="validate" name="roundtrip">
                  <label for="roundtrip">Return Trip</label>
                </div>      
            </div>                        

            <button class="btn waves-effect waves-light" type="submit" name="action">Search
              <i class="material-icons right">send</i>
            </button>   
        </div>
    </div>
</form>
            
<div class="card">
<div class="card-content">
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
                        <div>Airline : {{ $ticket->airline }}</div>
                        <div>Departure : {{ $ticket->dateofdeparture }}</div>
                        <div>Class : {{ $ticket->class }}</div>
                        <div>Origin : {{ $ticket->origin }}</div>
                        <div>Destination : {{ $ticket->destination }}</div>
                        <div>Return Ticket : {{{ $ticket->roundtrip == '1' ? 'Yes' : 'No' }}}</div>
			@if (Auth::user())
			<hr/>
			<form method="POST" action="{{ url('/ticket/trade') }}">
			   {!! csrf_field() !!}
			   <input type="hidden" name="id" value="{{ $ticket->id }}">
			   <input type="hidden" name="user_id" value="{{ $ticket->user_id }}">	
			   <button class="btn waves-effect waves-light" type="submit">Acquire using Credit
              			<i class="material-icons right">send</i>
            		   </button>
			</form>
			@endif
                    </div>
                </div>
            </div>    
        @endforeach
    @endif
</div>
</div>
</div>

@endsection
