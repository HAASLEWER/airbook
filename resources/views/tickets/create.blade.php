@extends('layouts.app')

@section('content')

<!-- Create Ticket -->
<!-- Display Validation Errors -->
@include('common.errors')
<form class="col s12" method="POST" action="{{ url('/ticket') }}">
    {!! csrf_field() !!}
    <div class="row">
        <div class="row">
            <div class="input-field col s12">
              <input id="ticketref" type="text" class="validate" length="13" name="ticketref">
              <label for="ticketref">Ticket Reference</label>
            </div>
        </div>    
        <div class="row">
            <div class="input-field col s12">
              <input id="airline" type="text" class="validate" name="airline">
              <label for="airline">Airline</label>
            </div>
        </div>  
        <div class="row">
            <div class="input-field col s12">
              <input id="dateofdeparture" type="text" class="validate" length="13" name="dateofdeparture">
              <label for="dateofdeparture">Date of Departure</label>
            </div>
        </div>  
        <div class="row">
            <div class="input-field col s12">
              <input id="origin" type="text" class="validate" length="13" name="origin">
              <label for="origin">City of Departure</label>
            </div>
        </div> 
        <div class="row">
            <div class="input-field col s12">
              <input id="destination" type="text" class="validate" length="13" name="destination">
              <label for="destination">Destination</label>
            </div>
        </div>                 
        <div class="row">
            <div class="input-field col s12">
              <input id="class" type="text" class="validate" length="13" name="class">
              <label for="class">Class</label>
            </div>
        </div>  
        <div class="row">
            <div class="input-field col s12">
              <input id="roundtrip" type="text" class="validate" length="13" name="roundtrip">
              <label for="roundtrip">Return Trip</label>
            </div>
        </div>           

        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right">send</i>
        </button>

    </div>
</form>

@endsection
