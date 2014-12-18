<?php
global $names;

if($com[0] == "ME")
{
	rLog('ME CALLED');

	// Server termination requested
	if(isset($com[1]))
	{
		rLog("#{$i} is {$com[1]}");
		$names[$i] = $com[1];
	}
	else
	{
		if (isset($names[$i]))
			socket_write_($client[$i]['sock'], '999 ' . $names[$i] . PHP_EOL);
		else
			socket_write_($client[$i]['sock'], '999 UNKNOWN' . PHP_EOL);	
	}
}
?>