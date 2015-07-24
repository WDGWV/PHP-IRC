<?php

//:MYUSERNAME PRIVMSG SERV    :COMMAND PARAMS
//$com[0]     $com[1] $com[2] $com[3]  $com[4]

if ( mod_loaded ( $com[4] ) )
{
	call_user_func("mod_{$com[4]}_unload()");

	mod_unload ( $com[4] );

	socket_write_($socket, ":Global!services@PHPIrc NOTICE {$com[1]} :Module {$com[4]} Unloaded.\r\n");
}

?>