<?php
function notRegistered ( $socket )
{
	socket_write($socket, ":PHPIrc 451 :You have not registered" . PHP_EOL);
}

function commands ($command, $socket)
{
	//echo "\$CMD: {$command} ";
	//exit.php   global.php last.php   me.php     term.php
	
	global $client, $i, $r;
	//$command 	= preg_replace("#(\r|\n|\r\n|\n\r)#", null, $command);
	$com   		= explode( " ", $command );
    $n     		= $com[0];

	include CMD . 'exit.php';
	// DO NOT PUT A COMMAND ABOVE THIS..
	include CMD . 'nick.php';
	include CMD . 'me.php';
	include CMD . 'join.php';

	include CMD . 'raw.php';
	include CMD . 'term.php';

	include CMD . 'global.php';

	// DO NOT PUT A COMMAND AFTER THIS
	include CMD . 'last.php';
}
?>