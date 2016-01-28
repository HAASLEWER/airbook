@extends('layouts.app')

@section('content')

<!-- Create Ticket -->

<link rel="stylesheet" href="{{ URL::asset('css/tickets/index.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/tickets/materialize.clockpicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/tickets/materialize.clockpicker.css') }}">
<script src="{{ URL::asset('js/materialize.clockpicker.js') }}"></script>

<div class="card">
        <div class="card-content">

	<h3>Submit Ticket</h3>

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

		<form method="POST" action="{{ url('/ticket') }}">
    		{!! csrf_field() !!}

    		<div class="row">

        	<div class="row">
            		<div class="input-field">
              			<input id="ticketref" type="text" class="validate" length="13" name="ticketref">
              			<label for="ticketref">Booking Reference/Code</label>
            		</div>
        	</div>    
		<div class="row">
                        <div class="input-field">
				<select  id="airline" class="validate" name="airline">
					<option value="" disabled selected>Select Airline</option>
                      			<option value="South African Airways">South African Airways</option>
                      			<option value="Kulula">Kulula</option>
                      			<option value="Mango">Mango</option>
                      			<option value="Safair">Safair</option>
					<option value="British Airways">British Airways</option>
                    		</select>
				<label for="airline">Airline</label>
                        </div>
                </div>
        	<div class="row">
            <div class="row">
                <label for="dateofdeparture">Date of Departure</label>
            		<div class="input-field">
              			<input id="dateofdeparture" type="text" class="datepicker" name="dateofdeparture">
                </div>
            </div>    
            <div class="row">
              <div class="input-field">
                <label for="input_starttime">Time of Departure</label>
                <input id="input_starttime" name="timeofdeparture" class="timepicker" type="text">
              </div>
            </div>        
        	</div>  
        	<div class="row">
            		<div class="input-field">
                    		<select  id="origin" class="validate" name="origin">
					<option value="" disabled selected>Select Origin</option>
                      			<option value="JNB">JNB</option>
                      			<option value="BFN">BFN</option>
                      			<option value="CPT">CPT</option>
                      			<option value="DBN">DBN</option>
                    		</select>
              			<label for="origin">City of Departure</label>
            		</div>
        	</div> 
        	<div class="row">
            		<div class="input-field">
                                <select  id="origin" class="validate" name="destination">
					<option value="" disabled selected>Select Destination</option>
                                        <option value="JNB">JNB</option>
                                        <option value="BFN">BFN</option>
                                        <option value="CPT">CPT</option>
                                        <option value="DBN">DBN</option>
                                </select>
              			<label for="destination">Destination</label>
            		</div>
        	</div>                 
        	<div class="row">
            		<div class="input-field">
				<select  id="class" class="validate" name="class">
                      			<option value="" disabled selected>Select Class</option>
                      			<option value="Economy">Economy</option>
                      			<option value="Business">Business</option>
                      			<option value="First">First</option>
                      			<option value="Premium">Premium</option>
                    		</select>
              			<label for="class">Class</label>
            		</div>
        	</div>  
        	<div class="row">
            		<div class="input-field">
              			<input id="roundtripCreate" type="checkbox" class="validate" name="roundtrip">
              			<label for="roundtripCreate">Return Trip</label>
				<br/><br/>
            		</div>
        	</div>           
		<div class="row" style="display: none;" id="DOR">
                <label for="dateofreturn">Date of Return</label>
                        <div class="input-field">
                                <input id="dateofreturn" type="text" class="datepicker" name="dateofreturn">
                </div>
            	</div>
            	<div class="row" style="display: none;" id="TOR">
              		<div class="input-field">
                	<label for="input_starttime2">Time of Return</label>
                	<input id="input_starttime2" name="timeofreturn" class="timepicker" type="text">
              	</div>
            	</div>

        	<button class="btn waves-effect waves-light" type="submit" name="action">Submit
          		<i class="material-icons right">send</i>
        	</button>

		</form>


		</div>
	</div>
</div>
</script>
@endsection
