var page = new WebPage(), testindex = 0, loadInProgress = false;
var system = require('system');

page.onConsoleMessage = function(msg) {
  console.log(msg);
};

page.onLoadStarted = function() {
  loadInProgress = true;
  console.log("load started");
};

page.onLoadFinished = function() {
  loadInProgress = false;
  console.log("load finished");
};

var steps = [
  function() {
    //Load Login Page
    page.settings.userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36';
    page.open("https://flights.kulula.com/SSW2010/E6IE/myb.html");
  },
  function() {
    var details = [system.args[1], system.args[2]];
    //Enter Credentials
    page.evaluate(function(deets) {

      var arr = document.getElementById("form_bookingretrieval_1");
      var i;

      for (i=0; i < arr.length; i++) { 
        if (arr[i].getAttribute('method') == "POST") {

          arr[i].elements["reservationCode"].value=deets[0];
          arr[i].elements["lastName"].value=deets[1];
          arr[i].elements["actionCode"].value="retrieveBooking";
          arr[i].elements["inOverlay"].value="false";
          return;
        }
      }
    }, details);
  }, 
  function() {
    //Login
    var details = [system.args[1], system.args[2]];
    page.evaluate(function(deets) {
      document.getElementById('bookingretrieval-lastName').value = deets[0];
      document.getElementById('bookingretrieval-reservationCode').value = deets[1];
      document.getElementById("form_bookingretrieval_1").submit();
    }, details);
  }, 
  function() {
    // Output content of page to stdout after form has been submitted
    page.evaluate(function() {
      console.log(document.querySelectorAll('html')[0].outerHTML);
    });
  }
];


interval = setInterval(function() {
  if (!loadInProgress && typeof steps[testindex] == "function") {
    console.log("step " + (testindex + 1));
    steps[testindex]();
    testindex++;
  }
  if (typeof steps[testindex] != "function") {
    console.log("test complete!");
    phantom.exit();
  }
}, 50);