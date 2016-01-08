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
		<a href="#sign_up_modal" id="download-button" class="btn-large waves-effect waves-light teal lighten-1 sign-up">Sign Up</a>
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
	        <h2 class="center brown-text"><i class="material-icons" style="font-size: 40px;">flash_on</i></h2>
	        <h5 class="center">Speeds up development</h5>

	        <p class="light" style="text-align: justify;">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
	      </div>
	    </div>

	    <div class="col s12 m4">
	      <div class="icon-block">
	        <h2 class="center brown-text"><i class="material-icons" style="font-size: 40px;">group</i></h2>
	        <h5 class="center">User Experience Focused</h5>

	        <p class="light" style="text-align: justify;">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
	      </div>
	    </div>

	    <div class="col s12 m4">
	      <div class="icon-block">
	        <h2 class="center brown-text"><i class="material-icons" style="font-size: 40px;">settings</i></h2>
	        <h5 class="center">Easy to work with</h5>

	        <p class="light" style="text-align: justify;">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
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
