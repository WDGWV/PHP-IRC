<?php
#function tryToCreateServer ( error=false )
# Try to create the server
## WdG: 13 APR 2014
function tryToCreateServer($error = false)
{
	global $sock, $host, $port;
	$WWE = true;

	if ( $error != false )
	{
		echo $error . SPACES . SPACES . PHP_EOL . SPACES . socket_strerror(socket_last_error()) . ' (Sleep for 20 seconds)' . SPACES . PHP_EOL . PHP_EOL;
		if($WWE)sleep(1);echo "\r".SPACES."[__________] \\ 05% (20 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[>_________] | 10% (19 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#_________] / 15% (18 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#>________] - 20% (17 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[##________] \\ 25% (16 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[##>_______] | 30% (15 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[###_______] / 35% (14 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[###>______] - 40% (13 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[####______] \\ 45% (12 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[####>_____] | 50% (11 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#####_____] / 55% (10 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#####>____] - 60% (09 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[######>___] \\ 65% (08 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#######___] | 70% (07 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#######>__] / 75% (06 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[########__] - 80% (05 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[########>_] \\ 85% (04 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#########_] | 90% (03 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[#########>] / 95% (02 sec. remaining.)\r";
		if($WWE)sleep(1);echo "\r".SPACES."[##########] - 99% (01 sec. remaining.)\r";
		if(!$WWE)sleep(5);
	}

	// Create socket
	$sock = @socket_create(AF_INET,SOCK_STREAM,0) or tryToCreateServer("[".date('Y-m-d H:i:s')."] Could not create socket");
	
	// Bind to socket
	@socket_bind($sock,$host,$port) or tryToCreateServer("[".date('Y-m-d H:i:s')."] Could not bind to socket");
	
	// Start listening
	@socket_listen($sock) or tryToCreateServer("[".date('Y-m-d H:i:s')."] Could not set up socket listener");
}

/*
	Trying to create the server.
*/
tryToCreateServer();

?>