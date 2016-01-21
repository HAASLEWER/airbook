var page = new WebPage(), testindex = 0, loadInProgress = false;
var system = require('system');

if (system.args.length !== 3) {
    console.log('Usage: britishairways.js <refCode> <lastName>');
    setTimeout(function() {
	phantom.exit();
    }, 0);
}

page.onConsoleMessage = function(msg) {
  console.log(msg);
};

page.onLoadStarted = function() {
  loadInProgress = true;
  //console.log("load started");
};

page.onLoadFinished = function() {
  loadInProgress = false;
  //console.log("load finished");
};

var steps = [
  function() {
    //Load Login Page
    page.settings.userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36';
    page.open("https://www.britishairways.com/travel/managebooking/public/en_gb");
  },
  function() {
    var details = [system.args[1], system.args[2]];
    //Enter Credentials
    page.evaluate(function(deets) {

      var arr = document.getElementById("simpleform");
      var i;

      for (i=0; i < arr.length; i++) { 
        if (arr[i].getAttribute('method') == "POST") {

          arr[i].elements["bookingRef"].value=deets[0];
          arr[i].elements["lastname"].value=deets[1];
          arr[i].elements["eId"].value="104002";
          arr[i].elements["Directional_Authentication"].value="";
	  arr[i].elements["display"].value="Find my booking";
          return;
        }
      }
    }, details);
  }, 
  function() {
    //Login
    var details = [system.args[1], system.args[2]];
    page.evaluate(function(deets) {
      document.getElementById('bookingRef').value = deets[0];
      document.getElementById('lastname').value = deets[1];
      document.getElementById("simpleform").submit();
    }, details);
  }, 
  function() {
    // Output content of page to stdout after form has been submitted
    page.evaluate(function() {
      //console.log(document.querySelectorAll('html')[0].outerHTML);
      var str = document.querySelectorAll('html')[0].outerHTML;
      if(str.indexOf("Sorry, we are unable to use your name as entered.") == -1 || str.indexOf("Sorry, We are unable to find your booking.") == -1 || str.indexOf("Booking Reference - This is a series of six letters and numbers.") == -1 ) {
        console.log('1');
      } else {
        console.log('0');
      }
    });
  }
];


interval = setInterval(function() {
  if (!loadInProgress && typeof steps[testindex] == "function") {
    //console.log("step " + (testindex + 1));
    steps[testindex]();
    testindex++;
  }
  if (typeof steps[testindex] != "function") {
    //console.log("test complete!");
    phantom.exit();
  }
}, 50);
