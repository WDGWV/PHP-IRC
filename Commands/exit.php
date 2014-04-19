<?php
if ( $com[0] == "EXIT" )
{
	if ( $client[$i]['sock'] != null )
	{
		// Disconnect requested
		socket_close (
						$client[$i]['sock']
					 );
		unset		 (
						$client[$i]['sock']
					 );
		rLog("Disconnected(2) client #".$i);

		for($p=0; $p<count($client); $p++)
		{
			socket_write(
							$client[$p]['sock'],
							"DISC " . $i . chr(0)
						);
		}

		//if($i == $adm)
		//{
		//	$adm = -1;
		//}
	}
}
?>