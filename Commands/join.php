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
		
		....
		JOIN #W2,#x
		MODE #W2,#x
		*/
		
		$test = explode(",", $com[1]);
		if ( sizeof($test) >= 1 )
		{
			for($i=0; $i<sizeof($test); $i++)
			{
				socket_write_($socket, $c = (":".$nick." JOIN " . $test[$i]) . PHP_EOL);
				socket_write_($socket, $test[$i] . " {$nick} {$nick} {$nick}@PHP.IRC :0 {$nick}{$nick}" . PHP_EOL );

				#Topic
				socket_write_($socket, "332 {$test[$i]} :http://www.wdgwv.com" . PHP_EOL );
				socket_write_($socket, "333 {$test[$i]} Global 902508764" . PHP_EOL );
				socket_write_($socket, ":Global MODE " . $test[$i] . " +ntr" . PHP_EOL );

				//socket_write_($socket, "353 = " . $test[$i] . " :@{$nick}" . PHP_EOL );
				//socket_write_($socket, "366 = " . $test[$i] . " :End of /NAMES list." . PHP_EOL );

				rLog("JOIN {$c}" . PHP_EOL);
			}
		}
		else
		{
			socket_write_($socket, $c = (":".$nick." JOIN " . $com[1]) . PHP_EOL);
			socket_write_($socket, $com[1] . " {$nick} {$nick} {$nick}@PHP.IRC :0 {$nick}{$nick}" . PHP_EOL );

			#Topic
			socket_write_($socket, "332 {$com[1]} :http://www.wdgwv.com" . PHP_EOL );
			socket_write_($socket, "333 {$com[1]} Global 902508764" . PHP_EOL );
			socket_write_($socket, ":Global MODE " . $com[1] . " +ntr" . PHP_EOL );

			//socket_write_($socket, "353 = " . $com[1] . " :@{$nick}" . PHP_EOL );
			//socket_write_($socket, "366 = " . $com[1] . " :End of /NAMES list." . PHP_EOL );

			rLog("JOIN {$c}" . PHP_EOL);
		}
	}
}
?>