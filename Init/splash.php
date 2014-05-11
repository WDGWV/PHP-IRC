<?php

if ( !file_exists( INIT . 'screen.rc' ) )
	exit('LICENCE ERROR!');

$f = file_get_contents(INIT . 'screen.rc');

echo base64_decode($f) . PHP_EOL . PHP_EOL;

?>