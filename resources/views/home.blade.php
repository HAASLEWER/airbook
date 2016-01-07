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
<div id="sign_up_modal" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h5>Sign Up</h5>
		<div class="row">
			<form class="col s12">
				<div class="row">
					<div class="input-field col s6">
					  <input id="first_name" type="text" class="validate">
					  <label for="first_name">First Name</label>
					</div>
					<div class="input-field col s6">
					  <input id="last_name" type="text" class="validate">
					  <label for="last_name">Last Name</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
					  <input id="rsa-id" type="text" class="validate" length="13">
					  <label for="rsa-id">RSA ID</label>
					</div>
				</div>  
				<div class="file-field input-field">
					<div class="btn">
						<span>File</span>
						<input type="file">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>	  
				<div class="row">
					<div class="input-field col s12">
					  <input id="email" type="email" class="validate">
					  <label for="email">Email</label>
					</div>
				</div>  
				<div class="row">
					<div class="input-field col s12">
					  <input id="password" type="password" class="validate">
					  <label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
					  <input id="confirm-password" type="password" class="validate">
					  <label for="confirm-password">Re-Type Password</label>
					</div>
				</div>  
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Sign Up</a>
	</div>
</div>

<!-- Login Modal -->
<form class="col s12" method="POST" action="{{ url('/login') }}">
<div id="login_modal" class="modal modal-fixed-footer" style="width: 300px; height: 370px;">
	<div class="modal-content">
		<h5>Login</h5>
		<div class="row">
				{!! csrf_field() !!}
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
		</div>
	</div>
	<div class="modal-footer">
		<input type="submit" value="Login" class="modal-action modal-close waves-effect waves-green btn-flat" />
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>
</form>

<script>
$(document).ready(function() {
	// Initialize paralax scrolling view
	$('.parallax').parallax();

	// Initialize Sign Up Button
	$('.sign-up').leanModal();

	// Initialize Login Button
	$('.login').leanModal({});	
});
</script>

@endsection
