<?php
/*
                   :....................,:,              
                ,.`,,,::;;;;;;;;;;;;;;;;:;`              
              `...`,::;:::::;;;;;;;;;;;;;::'             
             ,..``,,,::::::::::::::::;:;;:::;            
            :.,,``..::;;,,,,,,,,,,,,,:;;;;;::;`          
           ,.,,,`...,:.:,,,,,,,,,,,,,:;:;;;;:;;          
          `..,,``...;;,;::::::::::::::'';';';:''         
          ,,,,,``..:;,;;:::::::::::::;';;';';;'';        
         ,,,,,``....;,,:::::::;;;;;;;;':'''';''+;        
         :,::```....,,,:;;;;;;;;;;;;;;;''''';';';;       
        `,,::``.....,,,;;;;;;;;;;;;;;;;'''''';';;;'      
        :;:::``......,;;;;;;;;:::::;;;;'''''';;;;:       
        ;;;::,`.....,::;;::::::;;;;;;;;'''''';;,;;,      
        ;:;;:;`....,:::::::::::::::::;;;;'''':;,;;;      
        ';;;;;.,,,,::::::::::::::::::;;;;;''':::;;'      
        ;';;;;.;,,,,::::::::::::::::;;;;;;;''::;;;'      
        ;'';;:;..,,,;;;:;;:::;;;;;;;;;;;;;;;':::;;'      
        ;'';;;;;.,,;:;;;;;;;;;;;;;;;;;;;;;;;;;:;':;      
        ;''';;:;;.;;;;;;;;;;;;;;;;;;;;;;;;;;;''';:.      
        :';';;;;;;::,,,,,,,,,,,,,,:;;;;;;;;;;'''';       
         '';;;;:;;;.,,,,,,,,,,,,,,,,:;;;;;;;;'''''       
         '''';;;;;:..,,,,,,,,,,,,,,,,,;;;;;;;''':,       
         .'''';;;;....,,,,,,,,,,,,,,,,,,,:;;;''''        
          ''''';;;;....,,,,,,,,,,,,,,,,,,;;;''';.        
           '''';;;::.......,,,,,,,,,,,,,:;;;''''         
           `''';;;;:,......,,,,,,,,,,,,,;;;;;''          
            .'';;;;;:.....,,,,,,,,,,,,,,:;;;;'           
             `;;;;;:,....,,,,,,,,,,,,,,,:;;''            
               ;';;,,..,.,,,,,,,,,,,,,,,;;',             
                 '';:,,,,,,,,,,,,,,,::;;;:               
                  `:;'''''''''''''''';:.                 
                                                         
 ,,,::::::::::::::::::::::::;;;;,::::::::::::::::::::::::
 ,::::::::::::::::::::::::::;;;;,::::::::::::::::::::::::
 ,:; ## ## ##  #####     ####      ## ## ##  ##   ##  ;::
 ,,; ## ## ##  ## ##    ##         ## ## ##  ##   ##  ;::
 ,,; ## ## ##  ##  ##  ##   ####   ## ## ##   ## ##   ;::
 ,,' ## ## ##  ## ##    ##    ##   ## ## ##   ## ##   :::
 ,:: ########  ####      ######    ########    ###    :::
 ,,,:,,:,,:::,,,:;:::::::::::::::;;;:::;:;:::::::::::::::
 ,,,,,,,,,,,,,,,,,,,,,,,,:,::::::;;;;:::::;;;;::::;;;;:::
                                                         
	     (c) WDGWV. 2013, http://www.wdgwv.com           
	 websites, Apps, Hosting, Services, Development.      

  File Checked.
  Checked by: WdG.
  File created: WdG.
  date: 27-JAN-2014
  Last update: 24-MAR-2014
  
  Â© WDGWV, www.wdgwv.com
  All Rights Reserved.
*/

/*
	## DISCLAIMER // INFO 		##
	
This is a beta version for a PHP IRC server.
This is not functional right now!

This code is written by WdG (Wesley de Groot) 
This code is tested by WdG and EH (Edwin Huijboom)
This code is provided by WDGWV
more info? http://wdgwv.github.io/PHP-irc.html

	## END OF DISCLAIMER // INFO ##
*/

error_reporting(E_ALL);

include_once 'Config/config.php';
include_once 'Init/config.php';
include_once 'Init/define.php';
include_once INIT  . 'splash.php';
include_once FUNCS . 'rLog.php';
include_once FUNCS . 'tryToCreateServer.php';
include_once FUNCS . 'commands.php';

function socket_write_($sock, $cmd)
{
	rLog("=> {$cmd}");
	@socket_write(@$sock, $cmd);
}

$last = null;

rLog("Server started at ".$host.":".$port . SPACES . "\r\n");
// Server loop
while(true)
{
             socket_set_block($sock);
             // Setup clients listen socket for reading

             $read[0] = $sock;
             for($i = 0;$i<$max;$i++)
             {
             	if(@$client[$i]['sock'] != null)
					$read[$i+1] = $client[$i]['sock'];
             }

             // Set up a blocking call to socket_select()
             $ready = @socket_select($read,$write = NULL, $except = NULL, $tv_sec = NULL);

             // If a new connection is being made add it to the clients array
             if(in_array($sock,$read))
             {
                          for($i = 0;$i<$max;$i++)
                          {
                                       if(@$client[$i]['sock']==null)
                                       {
                                                    if((@$client[$i]['sock'] = socket_accept($sock))<0){
                                                                 rLog("socket_accept() failed: ".socket_strerror(@$client[$i]['sock'])."\r\n");
                                                    }else{
                                                                 rLog("Client #".$i." connected\r\n");
																 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :***************************************************\r\n");
																 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :***         Welcome by PHP Irc.                 ***\r\n");
																 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :*** © WDGWV, All Rights Reserved, www.wdgwv.com ***\r\n");
																 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :***************************************************\r\n");
																 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH : \r\n");
                                                                 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :*** Looking up your hostname...\r\n");
                                                                 #IFFOUND....
																

                                                                 $theIP = socket_getpeername ( $client[$i]['sock'] , $theHost , $thePort );
																 socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :*** Found your IP Adress ({$theHost} @ {$thePort})\r\n");

																 if ($hostname=gethostbyaddr($theHost))
                                                                 	{
                                                                 		socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :*** Found your hostname  ($hostname)\r\n");
                                                                 		$encHost = base64_encode($hostname);
                                                                 		$encHost = preg_replace("/=/", "_", $encHost);
                                                                 		socket_write_($client[$i]['sock'], ":PHPIrc NOTICE AUTH :*** Coded Hostname       ($encHost)\r\n");
                                                                 	}
                                                    }
                                                    break;
                                       }
                                       elseif($i == $max - 1)
                                       {													
													if( ( $client[$max]['sock'] = socket_accept($sock) ) < 0 )
													{
                                                                 rLog("socket_accept() failed: ".socket_strerror(@$client[$mac]['sock']) . "\r\n");
                                                    }
                                                    else
                                                    {
                                                                 rLog("Client #".$max." rejected" . "\r\n");
                                                    }
                                                    //killing the last...
                                                    $cdmp = "ERROR: #001 To much clients. Please try later\r\n";

                                                    socket_write_ ( $client[$max]['sock'], $cdmp );
                                                    socket_close  ( $client[$max]['sock'] );
                                                    unset         ( $client[$max]['sock'] );
                                       }
                          }
                          if(--$ready <= 0)
                          continue;
             }
             
             for($i=0;$i<$max;$i++)
             {
                          if(in_array(@$client[$i]['sock'],$read))
                          {
                                       $input = socket_read($client[$i]['sock'],1024);
                                       if($input==null)
                                       {
                                            unset($client[$i]);
                                       }
                                       $real_input = $input;

                                       $f = explode("\r\n", $input);
                                       for($r=0; $r<sizeof($f); $r++)
                                       {
                                       	if(!is_null($f[$r]))
                                       	{
                                       		if ($last != $i . '/' . $f[$r] &&
                                       			!empty($f[$r]))
                                       		{

                                       			rLog("{$i} Says: {$f[$r]}.\r\n");

                                       			commands (
                                       						$command = $f[$r], 
                                       						$socket  = $client[$i]['sock']
                                       					 );

                                       			$last = $i . '/' . $f[$r];
                                       		}
                                       	}
                                       }
                                       //$input = preg_replace("(\r|\n|\r\n|\n\r)", null, $input);
                                       //$n     = trim ( $input  );
                                       //$com   = explode( " ", $input );
                                       //$n     = $com[0];
                          }
                          else
                          {
                                       //if($client[$i]['sock']!=null){
                                                    // Close the socket
                                                    //socket_close($client[$i]['sock']);
                                                    //unset($client[$i]);
                                                    //rLog("Disconnected(1) client #".$i);
                                       //}
                          }
             }
}

// Close the master sockets
socket_close($sock);
?>