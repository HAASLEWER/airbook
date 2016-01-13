@extends('layouts.app')

@section('content')

<!-- Create Ticket -->
<!-- Display Validation Errors -->
@include('common.errors')

<div class="card">
        <div class="card-content">

	@if(Session::has('status'))
        <div class="row red darken-4">
                <span class="white-text">{{ Session::get('status') }}</span>
        </div>
	@endif

            <div class="row">

		<form method="POST" action="{{ url('/ticket') }}">
    		{!! csrf_field() !!}

    		<div class="row">

        		<div class="row">
            			<div class="input-field">
              				<input id="ticketref" type="text" class="validate" length="13" name="ticketref">
              				<label for="ticketref">Ticket Reference</label>
            			</div>
        		</div>    
        	<div class="row">
            		<div class="input-field">
              			<input id="airline" type="text" class="validate" name="airline">
              			<label for="airline">Airline</label>
            		</div>
        	</div>  
        	<div class="row">
            		<div class="input-field">
              			<input id="dateofdeparture" type="text" class="validate" length="13" name="dateofdeparture">
              			<label for="dateofdeparture">Date of Departure</label>
            		</div>
        	</div>  
        	<div class="row">
            		<div class="input-field">
              			<input id="origin" type="text" class="validate" length="13" name="origin">
              			<label for="origin">City of Departure</label>
            		</div>
        	</div> 
        	<div class="row">
            		<div class="input-field">
              			<input id="destination" type="text" class="validate" length="13" name="destination">
              			<label for="destination">Destination</label>
            		</div>
        	</div>                 
        	<div class="row">
            		<div class="input-field">
              			<input id="class" type="text" class="validate" length="13" name="class">
              			<label for="class">Class</label>
            		</div>
        	</div>  
        	<div class="row">
            		<div class="input-field">
              			<input id="roundtrip" type="text" class="validate" length="13" name="roundtrip">
              			<label for="roundtrip">Return Trip</label>
            		</div>
        	</div>           

        	<button class="btn waves-effect waves-light" type="submit" name="action">Submit
          		<i class="material-icons right">send</i>
        	</button>

		</form>


		</div>
	</div>
</div>
@endsection
