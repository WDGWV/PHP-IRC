<?php
if($com[0]=="GLOBAL")
{
	global $max;
	
	// Server termination requested
	rLog("GLOBAL MESSAGE BY #{$i}");

	for($i_i = 0;$i_i<$max;$i_i++)
	{
		socket_write_($client[$i_i]['sock'], "TEST FOR GLOBAL MESSAGES..." . PHP_EOL);
	}
}
?>