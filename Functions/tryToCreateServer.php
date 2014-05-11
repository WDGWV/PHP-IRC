<?php
#function tryToCreateServer ( error=false )
# Try to create the server
## WdG: 13 APR 2014
function tryToCreateServer($error = false)
{
	global $sock, $host, $port;

	if ( $error != false )
	{
		echo $error . PHP_EOL . SPACES . socket_strerror(socket_last_error()) . ' (Sleep for 20 seconds)' . PHP_EOL;
		sleep(20);
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