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
		<form id="contact" method="POST" action="{{ url('/contact') }}">
			{!! csrf_field() !!}
			<h1>Contact Us</h1>
			<p>Please feel free to provide us with your feedback.</p>
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
			<label for="email">Name</label>					
			<input id="name" name="name" type="text" class="validate"/>
			<label for="email">Email</label>
			<input id="email" name="email" type="email" class="validate">
			<label for="email">Message</label>
			<div class="input-field col s12">
			    <textarea id="textarea1" name="message" class="materialize-textarea"></textarea>
		    </div>
		    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          		<i class="material-icons right">send</i>
        	</button>
		</form>

	</div>
</div>

<!-- Sign Up Modal -->
<form class="col s12" method="POST" action="{{ url('/register') }}">
{!! csrf_field() !!}
<div id="sign_up_modal" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h5>Sign Up</h5>
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
