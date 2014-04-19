<?php
/*
if($input)
{
	// Strip whitespaces and write back to user
	// Respond to commands
	//$output = ereg_replace("[ \t\n\r]","",$input).chr(0);
	//socket_write($client[$i]['sock'],$output);

	if($n=="PING")
	{
		socket_write($client[$i]['sock'],"PONG".chr(0));
	}

	if($n=="<policy-file-request/>")
	{
		rLog("Client #".$i." requested a policy file...");
		$cdmp="<?xml version=\"1.0\" encoding=\"UTF-8\"?><cross-domain-policy xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"http://www.adobe.com/xml/schemas/PolicyFileSocket.xsd\"><allow-access-from domain=\"*\" to-ports=\"*\" secure=\"false\" /><site-control permitted-cross-domain-policies=\"master-only\" /></cross-domain-policy>";
		socket_write($client[$i]['sock'],$cdmp.chr(0));
		socket_close($client[$i]['sock']);
		unset($client[$i]);
		$cdmp="";
	}
}
*/
?>