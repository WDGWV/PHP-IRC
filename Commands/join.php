<?php
if ( $com[0] == "JOIN" )
{
	global $host;
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
		#B0P's B0T H@ bop@playing.with.my.pet.IRCop.com :5 B0P's B0T - http://mirc-egg.net
		socket_write_($socket, $com[1] . " {$nick} {$nick} {$nick}@PHP.IRC :0 {$nick}{$nick}" . PHP_EOL );

		#Topic
		socket_write_($socket, "332 {$com[1]} : http://www.wdgwv.com" . PHP_EOL );
		socket_write_($socket, "333 {$com[1]} Global 902508764" . PHP_EOL );
		socket_write_($socket, ":Global MODE " . $com[1] . " +ntr" . PHP_EOL );

		//socket_write_($socket, "353 = " . $com[1] . " :@{$nick}" . PHP_EOL );
		//socket_write_($socket, "366 = " . $com[1] . " :End of /NAMES list." . PHP_EOL );



		rLog("JOIN {$c}" . PHP_EOL);
	}
}
?>