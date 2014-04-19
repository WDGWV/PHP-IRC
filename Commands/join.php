<?php
if ( $com[0] == "JOIN" )
{
	rLog("JOIN CHANNEL" . PHP_EOL);
	if ( !isset ( $nicks['pid_' . $i] ) )
	{
		notRegistered($socket);
		rLog("NOT REGISTERED" . PHP_EOL);
	}
	else
	{
		$nick = $nicks['pid_'.$i];
		/*
		:Wesley!Wesley@CW-EBA233BB.xs4all.nl JOIN :#x
		:PHPIrc MODE #x +nt 
		:PHPIrc 353 Wesley = #x :@Wesley 
		:PHPIrc 366 Wesley #x :End of /NAMES list.
		*/
		
		socket_write_($socket, $c = (":".$nick." JOIN " . $com[1]) );

		socket_write_($socket, ":PHPIrc MODE " . $com[1] . " +nt " . PHP_EOL );
		socket_write_($socket, ":PHPIrc 353 {$nick} = " . $com[1] . " :@{$nick} " . PHP_EOL );
		socket_write_($socket, ":PHPIrc 366 {$nick} = " . $com[1] . " :End of /NAMES list." . PHP_EOL );

		rLog("JOIN {$c}" . PHP_EOL);
	}
}
?>