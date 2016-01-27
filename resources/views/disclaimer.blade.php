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
	    <div class="row s12 m4">
		<h1>Legal Disclaimer</h1>
			<p> If you require any more information or have any questions about our site's disclaimer, please feel free to contact us by email at <a href="&#109;&#97;&#105;&#108;&#116;&#111;:&#105;&#110;&#102;&#111;&#64;&#111;&#112;&#101;&#110;&#109;&#97;&#110;&#97;&#103;&#101;&#46;&#99;&#111;&#46;&#122;&#97;">&#105;&#110;&#102;&#111;&#64;&#111;&#112;&#101;&#110;&#109;&#97;&#110;&#97;&#103;&#101;&#46;&#99;&#111;&#46;&#122;&#97;</a>

			<br /><br /><strong>Disclaimers for airbook.openmanage.co.za:</strong>
			<p>
			All the information on this website is published in good faith and for general information purpose only. airbook.openmanage.co.za does not make any warranties about the completeness, reliability and accuracy of this information. Any action you take upon the information you find on this website (airbook.openmanage.co.za), is strictly at your own risk. airbook.openmanage.co.za will not be liable for any losses and/or damages in connection with the use of our website.
			</p>
			<p>
			From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link which may have gone 'bad'.
			</p>
			<p>
			Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.
			</p>

		<strong>Consent</strong>
		<p>
		By using our website, you hereby consent to our disclaimer and agree to its terms.
		</p><strong>Update</strong>This site disclaimer was last updated on: Wednesday, January 27th, 2016<br /><em> · Should we update, amend or make any changes to this document, those changes will be prominently posted here.</em><br /><br /><hr />
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
