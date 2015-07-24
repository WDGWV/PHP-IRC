<?php

if ( $com[0] == "PING" )
{
	global $host;

	$ret  = $com[1];
	$ret  = preg_replace("/(\r|\n|\r\n|\n\r)/", null, $ret);

	$nick = $nicks['pid_'.$i];
	socket_write_($socket, $rts=":PHPIrc PONG {$ret}" . PHP_EOL );
}

?>