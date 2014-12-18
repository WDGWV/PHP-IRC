<?php
#function rLog ( msg )
# Log a message
## WdG: 13 APR 2014
function rLog($msg)
{
	global $RMP;
	if(!isset($RMP)) $RMP=date('ymd-His');

	print("[".date('Y-m-d H:i:s')."] " . $msg);
	file_put_contents(
					   $file = "Logs/" . $RMP . ".log", 
					   @file_get_contents($file) . 
					   "[".date('Y-m-d H:i:s')."] " . $msg
					  );
}
?>