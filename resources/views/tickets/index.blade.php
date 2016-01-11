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
                    <select  id="airline" class="validate">
                      <option value="" disabled selected>Select Airline</option>
                      <option value="1">SAA</option>
                      <option value="2">Kulula</option>
                      <option value="3">Mango</option>
                      <option value="3">Safair</option>
                    </select>
                    <label>Airline</label>
                </div>
                <div class="input-field col s4">
                  <input id="dateofdeparture" type="text" class="validate" name="dateofdeparture">
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

<script>
$(document).ready(function() {
    // Initialize dropdowns
    $('select').material_select();

    // I don't know why materialize didn't cater for this
    // but anyway this just sets the input field name to whatever
    // the select's id is
    $('select').change(function(e) {
        $('select').material_select();
        var input = $(this).parent().find(".select-dropdown")[0];
        $(input).attr("name", $(this)[0].id);
    });    
});
</script>

@endsection