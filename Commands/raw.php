<?php

if ( $com[0] == "RAW" )
{
	global $host;
	rLog("RAW" . PHP_EOL);
	if ( !isset ( $nicks['pid_' . $i] ) )
	{
		notRegistered($socket);
		rLog("NOT REGISTERED" . PHP_EOL);
	}
	else
	{
		$nick = $nicks['pid_'.$i];
		$comm = $com;unset($comm[0]);$comm=implode(" ", $comm);
		socket_write_($socket, $comm . PHP_EOL );

		rLog("*** RAW {$comm}" . PHP_EOL);
	}
}

?>