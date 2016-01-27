@extends('layouts.app')

@section('content')

<div class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center" style="color: white;">AirBook</h1>
        <div class="row center">
          <h5 class="header col s12 light" style="color: white;">Trade airline tickets for other airline tickets</h5>
        </div>
	<div class="row center">
		@if (!Auth::user())
		<a href="#sign_up_modal" id="download-button" class="btn-large waves-effect waves-light teal lighten-1 sign-up">Sign Up</a><br /><br />
		@endif
		<a href="/tickets" id="download-button" class="btn-large waves-effect waves-light teal lighten-1 sign-up">Browse Tickets</a>
        </div>
        <br><br>

      </div>
    </div>	
	<div class="parallax"><img src="img/plane.jpg"></div>
</div>

<div class="container">
	<div class="section">

	  <!--   Icon Section   -->
	  <div class="row">
	    <div class="col s12 m4">
	      <div class="icon-block">
	        <h2 class="center teal-text"><i class="material-icons" style="font-size: 40px;">add</i></h2>
	        <h5 class="center">Add Valid Ticket</h5>

	        <p class="light" style="text-align: justify;">Simply submit valid airline tickets to become eligable for trade credit! Tickets are verified to ensure authenticity and are valid up untill the departure date of the ticket has been met. <i>Eligibality for ticket trading is lost if submitted tickets are no longer valid.</i></p>
	      </div>
	    </div>

	    <div class="col s12 m4">
	      <div class="icon-block">
	        <h2 class="center teal-text"><i class="material-icons" style="font-size: 40px;">search</i></h2>
	        <h5 class="center">Search Tradable Tickets</h5>

	        <p class="light" style="text-align: justify;">Effortlessly search through our valid tickets which are available for trading! Trawl through all available tickets or filter search results to suit your needs with Airliner, Destination, Departure Date and many more fields to choose from!</p>
	      </div>
	    </div>

	    <div class="col s12 m4">
	      <div class="icon-block">
	        <h2 class="center teal-text"><i class="material-icons" style="font-size: 40px;">swap_horiz</i></h2>
	        <h5 class="center">Trade Tickets</h5>

	        <p class="light" style="text-align: justify;">Instantly trade your credit for a ticket and gain access to your new tickets reference number! Once you are in possesion of your new ticket reference, you may redeem that ticket with its relevant airliner.</p>
	      </div>
	    </div>
	  </div>

	</div>
</div>

<!-- Sign Up Modal -->
<form class="col s12" method="POST" action="{{ url('/register') }}">
{!! csrf_field() !!}
<div id="sign_up_modal" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h5>Sign Up</h5>
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
				<div class="row">
					<div class="input-field col s6">
					  <input id="first_name" type="text" class="validate" name="name">
					  <label for="first_name">First Name</label>
					</div>
					<div class="input-field col s6">
					  <input id="last_name" type="text" class="validate" name="lastname">
					  <label for="last_name">Last Name</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
					  <input id="rsa-id" type="text" class="validate" length="13" name="idnumber">
					  <label for="rsa-id">RSA ID</label>
					</div>
				</div>  
				<div class="row">
					<div class="input-field col s12">
					  <input id="email" type="email" class="validate" name="email">
					  <label for="email">Email</label>
					</div>
				</div>  
				<div class="row">
					<div class="input-field col s12">
					  <input id="password" type="password" class="validate" name="password">
					  <label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
					  <input id="confirm-password" type="password" class="validate" name="password_confirmation">
					  <label for="confirm-password">Re-Type Password</label>
					</div>
				</div>  
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
		<input type="submit" value="Sign Up" class="modal-action modal-close waves-effect waves-green btn-flat" />
	</div>
</div>
</form>

@endsection
