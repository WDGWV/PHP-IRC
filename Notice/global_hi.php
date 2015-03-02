<?php

//:MYUSERNAME PRIVMSG SERV    :COMMAND PARAMS
//$com[0]     $com[1] $com[2] $com[3]  $com[4]

socket_write_($socket, ":Global!services@PHPIrc NOTICE {$com[1]} :Hi.\r\n");

?>