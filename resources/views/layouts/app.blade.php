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
          <a href="#!" class="brand-logo" style="margin-left: 45px;"><i class="material-icons" style="display:inline-block;">airplanemode_active</i>Airbook</a>

          <a href="#" data-activates="mobile-demo" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="/">Home</a></li>
            <li><a href="/tickets">Browse</a></li>
	    	@if (Auth::user())
                        <li><a href="/tickets/create" class="create">Add Ticket</a></li>
			<li><a href="/profile">My Profile</a></li>
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
			<li><a href="/profile">My Profile</a></li>
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
		
		//Timepicker stuff
		$('#input_starttime').pickatime({
    			twelvehour: false
  		});

  		$('#input_starttime2').pickatime({
    			twelvehour: false
  		});

		//roundtrip hidden fields stuff...
		$('#roundtripCreate').change(function(){
			if (this.checked) { 
				$('#DOR').css('display', '');
				$('#TOR').css('display', '');
			} else {
				$('#DOR').css('display', 'none');
				$('#dateofreturn').val('');
                                $('#TOR').css('display', 'none');
				$('#input_starttime2').val('');
			}
		});

	});

      </script>

      @yield('content')
	
	<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Prototype Application</h5>
                <p class="grey-text text-lighten-4">This application is intended for use as a proof of concept and should not enter full scale production without the explicit permission of the stakeholders involved in the project.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
		  <li><a class="grey-text text-lighten-3" target="_blank" href="http://www.mandelbrot.co.za">Developed By Mandelbrot Technologies</a></li>
                  <li><a class="grey-text text-lighten-3" target="_blank" href="http://www.openmanage.co.za">Hosted By Openmanage</a></li>
                  <li><a class="grey-text text-lighten-3" href="/privacy">Privacy Policy</a></li>
                  <li><a class="grey-text text-lighten-3" href="/disclaimer">Legal Disclaimer</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2016 Copyright Airbook
            </div>
          </div>
        </footer>

    </body>
</html>
