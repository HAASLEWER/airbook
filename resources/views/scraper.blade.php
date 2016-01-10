<?php

use Goutte\Client;

$client = new Client();
$crawler = $client->request('GET', 'https://www.flysaa.com/za/en/searchpnr.secured?loc=za&lan=en');

$form = $crawler->selectButton('LOGIN')->form();
$form['pnrCode'] = 'ZYF002';
$form['surName'] = 'Moolman';
$form['windowResLogin'] = '';
$form['abmjasa'] = 'SEARCH';

$crawler = $client->submit($form);

if (strpos($crawler->text(),'Your reservation number could not be found') !== false) {
    echo 'Ticket could not be verified';
} else {
	echo 'Ticket Verified';
}