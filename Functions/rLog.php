<?php
#function rLog ( msg )
# Log a message
## WdG: 13 APR 2014
function rLog($msg)
{
	print("[".date('Y-m-d H:i:s')."] " . $msg . PHP_EOL);
}

?>