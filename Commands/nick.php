<?php
global $nicks;
if (!isset($nicks))
	$nicks=array();

if($com[0] == "NICK")
{
	rLog('NICK');

	// Server termination requested
	if(!isset($nicks[$com[1]]))
	{
		$nicks[$com[1]] = $i;
		$nicks['pid_'.$i] = $com[1];
		
		socket_write($socket, "PING :PHPIrc" . PHP_EOL);
	}
	else
	{
		socket_write($socket, ':PHPIrc 433 * ' . $com[1] . ' :Nickname is already in use.' . PHP_EOL);
	}
}
?>