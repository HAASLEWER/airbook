<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>      
      <title>AirBook</title>

      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">      
    </head>
    <body>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

      <nav>
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo" style="margin-left: 45px;"><i class="material-icons">airplanemode_active</i></a>
          <a href="#!" class="brand-logo" style="margin-left: 80px;">AirBook</a>

          <a href="#" data-activates="mobile-demo" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="/">Home</a></li>
            <li><a href="/tickets">Browse</a></li>
	    	@if (Auth::user())
                        <li><a href="/tickets/create" class="create">Add Ticket</a></li>
			<li><a href="#">Settings</a></li>
			<li><a href="/logout" class="logout">Logout</a></li>
		@else
			<li><a href="#login_modal" class="login">Login</a></li>
		@endif
          </ul>
          <ul class="side-nav" id="mobile-demo">
            <li><a href="/">Home</a></li>
            <li><a href="/tickets">Browse</a></li>
		@if (Auth::user())
                        <li><a href="/tickets/create" class="create">Add Ticket</a></li>
			<li><a href="#">Settings</a></li>
			<li><a href="/logout" class="logout">Logout</a></li>
		@else
			<li><a href="#login_modal" class="login">Login</a></li>
                @endif
          </ul>

        </div>
      </nav>

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

      <!-- Javascript -->
      <script>

      	$(".button-collapse").sideNav();
	$(document).ready(function() {
        	// Initialize paralax scrolling view
        	$('.parallax').parallax();

        	// Initialize Sign Up Button
        	$('.sign-up').leanModal();

        	// Initialize Login Button
        	$('.login').leanModal({});      

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

		$('.datepicker').pickadate( {
    			selectMonths: true, // Creates a dropdown to control month
    			selectYears: 15, // Creates a dropdown of 15 years to control year
			format: 'yyyy-mm-dd'
  		});

	});

      </script>

      @yield('content')

    </body>
</html>
