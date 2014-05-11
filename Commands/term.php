<?php
if($com[0]=="TERM")
{
	// Server termination requested
	socket_close($sock);
	
	rLog("Terminated server (requested by client #".$i.")");

	exit();
}
?>