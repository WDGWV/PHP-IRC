<?php
if($com[0]=="GLOBAL")
{
	// Server termination requested
	rLog("GLOBAL MESSAGE BY #{$i}");

	for($i_i = 0;$i_i<$max;$i_i++)
	{
		socket_write($client[$i_i]['sock'], "TEST FOR GLOBAL MESSAGES..." . PHP_EOL);
	}
}
?>