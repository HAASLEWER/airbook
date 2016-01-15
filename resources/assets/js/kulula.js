"use strict";
var page = require('webpage').create(),
	resources = [];
var system = require('system');

page.onLoadFinished = function(status) {
	console.log('Load Complete');
};

page.onResourceReceived = function(response) {
    // apply resource filter if needed:
    if (response.headers.filter(function(header) {
    	if (header.name == 'Content-Type' && header.value.indexOf('text/html') == 0) {
    	    return true;
        }
        return false;
    }).length > 0)
    	resources.push(response);
    };

page.onResourceError = function(resourceError) {
    page.reason = resourceError.errorString;
    page.reason_url = resourceError.url;
};

if (system.args.length !== 3) {
	console.log('Usage: kulula.js <refCode> <lastName>');
	phantom.exit(1);
} else {
	var details = [system.args[1], system.args[2]]

	page.settings.userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36';

	page.open('https://flights.kulula.com/SSW2010/E6IE/myb.html', function(status) {
	console.log('HTTP status Code: ' + resources[0].status);
	console.log('Status : ' + status);
	console.log('Status Reason : ' + page.reason);
	console.log(page.reason_url);
    	setTimeout(function() {
        	page.evaluate(function(deets) {
			//console.log(deets[0]);
			setTimeout(document.querySelector('input[name=reservationCode]').value = deets[0], 1000);
			setTimeout(document.querySelector('input[name=lastName]').value = '"'+deets[1]+'"' , 1000);
			setTimeout(document.querySelector('input[name=actionCode]').value = '"retrieveBooking"', 1000);
			setTimeout(document.querySelector('input[name=inOverlay]').value = "false", 1000);
			setTimeout(document.querySelector('input[name=brSubmit]').click(), 1000);
			setTimeout(document.getElementById('form_bookingretrieval_1').submit(), 5000);
        	}, details);
    	}, 10000);
	var submit = page.evaluate(function() {
		return document.title;
	});
	console.log(submit);
	});

	/*var url = 'https://flights.kulula.com/SSW2010/E6IE/myb.html';
	var data = "reservastionCode=" + system.args[1] + "&lastName=" + system.args[2] + "&actionCode=retrieveBooking&inOverlay=false&brSubmit=view / change flight&componentTypes=bookingretrieval";

	page.open(url, 'post', data, function (status) {
    		if (status !== 'success') {
        		console.log('Unable to post!');
    		} else {
        		console.log(page.title);
    		}
    	phantom.exit();
	});*/
	
}
