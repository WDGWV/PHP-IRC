<?php
if ( $com[0] == "JOIN" )
{
/*
> JOIN #test
< :Wes!Wes@GlobalChat-4e854a17.upc-e.chello.nl JOIN :#Test
> MODE #Test
> WHO #Test
< :irc2.GlobalChat.nl 332 Wes #Test :9,2T7,2e9,2ST12,1 - 8,1 -->>> oFFiCiaL BoT & SCRiPTeRS CeNTRaL <<<-- 12,1 - 4,1 Test hier al je bots & scripts 9,2T7,2e9,2ST
< :irc2.GlobalChat.nl 333 Wes #Test ^StarLight^ 1356204456
< :irc2.GlobalChat.nl 353 Wes = #Test :@BarTender ~^StarLight^ DMG-SAN Wes 
< :irc2.GlobalChat.nl 366 Wes #Test :End of /NAMES list.
< :irc2.GlobalChat.nl 324 Wes #Test +Gnrt
< :irc2.GlobalChat.nl 329 Wes #Test 1416863300
< :irc2.GlobalChat.nl 352 Wes #Test BarTender GlobalChat-794573df.static.versatel.nl no BarTender H@ :0 BarTender
< :irc2.GlobalChat.nl 352 Wes #Test netadmin NetAdmin.GlobalChat.nl no ^StarLight^ H*~ :0 netadmin
< :irc2.GlobalChat.nl 352 Wes #Test norahsg IRCop.GlobalChat.nl no DMG-SAN H* :0 DMG
< :irc2.GlobalChat.nl 352 Wes #Test Wes GlobalChat-4e854a17.upc-e.chello.nl no Wes H :0 Wesley de Groot
< :irc2.GlobalChat.nl 315 Wes #Test :End of /WHO list.
*/
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
		socket_write_($socket, ":Global!services@PHPIrc MODE " . $com[1] . " +ntr" . PHP_EOL );

		//socket_write_($socket, "353 = " . $com[1] . " :@{$nick}" . PHP_EOL );
		//socket_write_($socket, "366 = " . $com[1] . " :End of /NAMES list." . PHP_EOL );



		rLog("JOIN {$c}" . PHP_EOL);
	}
}
?>