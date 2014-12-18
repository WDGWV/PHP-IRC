<?php
global $nicks;
if (!isset($nicks))
	$nicks=array();

if($com[0] == "NICK")
{
	rLog('NICK');

	// Server termination requested
	if(!isset($nicks[$com[1]]))
	{
		$nicks[$com[1]] = $i;
		$nicks['pid_'.$i] = $com[1];
		
		socket_write_($socket, "PING :PHPIrc" . PHP_EOL);
		socket_write_($socket, ":PHPIrc 001 {$com[1]} :Welcome to the PHPIrcServer IRC Network {$com[1]}!{$com[1]}@At.PHPIrc\r\n");
		socket_write_($socket, ":PHPIrc 002 {$com[1]} :Your host is PHPIrcServer, running version PHPIrc 0.0.1\r\n");
		socket_write_($socket, ":PHPIrc 003 {$com[1]} :This server was created Wed Jan 30 2013 at 21:16:57 CET\r\n");
		socket_write_($socket, ":PHPIrc 004 {$com[1]} PHP Irc0.0.1 iowghraAsORTVSxNCWqBzvdHtGpID lvhopsmntikrRcaqOALQbSeIKVfMCuzNTGjZ\r\n");
		socket_write_($socket, ":PHPIrc 005 {$com[1]} CMDS=KNOCK,MAP,DCCALLOW,USERIP,STARTTLS UHNAMES NAMESX SAFELIST HCN MAXCHANNELS=30 CHANLIMIT=#:30 MAXLIST=b:500,e:500,I:500 NICKLEN=30 CHANNELLEN=32 TOPICLEN=307 KICKLEN=307 AWAYLEN=307 :are supported by this server\r\n");
		socket_write_($socket, ":PHPIrc 005 {$com[1]} MAXTARGETS=20 WALLCHOPS WATCH=128 WATCHOPTS=A SILENCE=15 MODES=12 CHANTYPES=# PREFIX=(qaohv)~&@%+ CHANMODES=beI,kfL,lj,psmntirRcOAQKVCuzNSMTGZ NETWORK=PHPIrc CASEMAPPING=ascii EXTBAN=~,qjncrRa ELIST=MNUCT :are supported by this server\r\n");
		socket_write_($socket, ":PHPIrc 005 {$com[1]} STATUSMSG=~&@%+ EXCEPTS INVEX :are supported by this server\r\n");
		socket_write_($socket, ":PHPIrc 251 {$com[1]} :There are 1 users and 422 invisible on 5 servers\r\n");
		socket_write_($socket, ":PHPIrc 252 {$com[1]} 53 :operator(s) online\r\n");
		socket_write_($socket, ":PHPIrc 254 {$com[1]} 190 :channels formed\r\n");
		socket_write_($socket, ":PHPIrc 255 {$com[1]} :I have 114 clients and 1 servers\r\n");
		socket_write_($socket, ":PHPIrc 265 {$com[1]} 114 207 :Current local users 114, max 207\r\n");
		socket_write_($socket, ":PHPIrc 266 {$com[1]} 423 2200 :Current global users 423, max 2200\r\n");
		socket_write_($socket, ":PHPIrc 375 {$com[1]} :- PHPIrc Message of the Day - \r\n");
		socket_write_($socket, ":PHPIrc 372 {$com[1]} :- 8/3/2014 13:05\r\n");
		socket_write_($socket, ":PHPIrc 372 {$com[1]} :- Laatste aanpassing op 8/3/2014 @ 13:13\r\n");
		socket_write_($socket, ":PHPIrc 376 {$com[1]} :End of /MOTD command.\r\n");
		socket_write_($socket, ":{$com[1]} MODE {$com[1]} :+iwx\r\n");
		socket_write_($socket, ":Global!services@PHPIrc NOTICE {$com[1]} :Follow @WDGWV\r\n");
	}
	else
	{
		socket_write_($socket, ':PHPIrc 433 * ' . $com[1] . ' :Nickname is already in use.' . PHP_EOL);
	}
}
?>