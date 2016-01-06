<!DOCTYPE html>
<html>
    <head>
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
            <li><a href="#">Browse</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#login_modal" class="login">Login</a></li>
          </ul>
          <ul class="side-nav" id="mobile-demo">
            <li><a href="/">Home</a></li>
            <li><a href="#">Browse</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#login_modal" class="login">Login</a></li>
          </ul>
        </div>
      </nav>

      <script>
      $(".button-collapse").sideNav();
      </script>

      @yield('content')
    </body>
</html>