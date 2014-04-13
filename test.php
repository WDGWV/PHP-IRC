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

include_once 'Config/config.php';
include_once 'Init/config.php';
include_once 'Init/define.php';
include_once INIT . 'splash.php';
include_once FUNCS . 'rLog.php';
include_once FUNCS . 'tryToCreateServer.php';

rLog("Server started at ".$host.":".$port);
// Server loop
while(true){
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
                                       if($client[$i]['sock']==null)
                                       {
                                                    if(($client[$i]['sock'] = socket_accept($sock))<0){
                                                                 rLog("socket_accept() failed: ".socket_strerror($client[$i]['sock']));
                                                    }else{
                                                                 rLog("Client #".$i." connected");
                                                    }
                                                    break;
                                       }
                                       elseif($i == $max - 1)
                                       {													
													if( ( $client[$max]['sock'] = socket_accept($sock) ) < 0 )
													{
                                                                 rLog("socket_accept() failed: ".socket_strerror($client[$mac]['sock']));
                                                    }
                                                    else
                                                    {
                                                                 rLog("Client #".$max." rejected");
                                                    }
                                                    //killing the last...
                                                    $cdmp="ERROR: #001 To much clients. Please try later\r\n";

                                                    socket_write($client[$max]['sock'],$cdmp);
                                                    socket_close($client[$max]['sock']);
                                                    unset($client[$max]['sock']);
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
                                       $input = preg_replace("(\r|\n|\r\n|\n\r)", null, $input);
                                       $n     = trim ( $input  );
                                       $com   = explode( " ", $input );
                                       $n     = $com[0];

                                       rLog("{$i} Says: {$com[0]}.");
                                       print_r($com);

                                       if($n=="EXIT")
                                       {
                                            if($client[$i]['sock']!=null)
                                            {
                                                // Disconnect requested
                                                socket_close($client[$i]['sock']);
                                                unset($client[$i]['sock']);
                                                rLog("Disconnected(2) client #".$i);
                                                for($p=0;$p<count($client);$p++)
                                                {
                                                	socket_write($client[$p]['sock'],"DISC ".$i.chr(0));
                                                }
                                                if($i == $adm)
                                                {
                                                	$adm = -1;
                                                }
                                            }
                                       }
                                       elseif($com[0] == "ME")
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
                                       						socket_write($client[$i]['sock'], '999 ' . $names[$i] . PHP_EOL);
                                       					else
                                       						socket_write($client[$i]['sock'], '999 UNKNOWN' . PHP_EOL);	
                                       				}
                                       }
                                       elseif($n=="GLOBAL")
                                       {
                                                    // Server termination requested
                                       				rLog("GLOBAL MESSAGE BY #{$i}");
                          							for($i_i = 0;$i_i<$max;$i_i++)
                                       				{
                                       					socket_write($client[$i_i]['sock'], "TEST FOR GLOBAL MESSAGES..." . PHP_EOL);
                                       				}

                                       }
                                       elseif($n=="TERM"){
                                                    // Server termination requested
                                                    socket_close($sock);
                                                    rLog("Terminated server (requested by client #".$i.")");
                                                    exit();
                                       }
                                       elseif($input)
                                       {
                                                    // Strip whitespaces and write back to user
                                                    // Respond to commands
                                                    /*$output = ereg_replace("[ \t\n\r]","",$input).chr(0);
                                                    socket_write($client[$i]['sock'],$output);*/
                                                    if($n=="PING"){
                                                                 socket_write($client[$i]['sock'],"PONG".chr(0));
                                                    }
                                                    if($n=="<policy-file-request/>"){
                                                                 rLog("Client #".$i." requested a policy file...");
                                                                 $cdmp="<?xml version=\"1.0\" encoding=\"UTF-8\"?><cross-domain-policy xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"http://www.adobe.com/xml/schemas/PolicyFileSocket.xsd\"><allow-access-from domain=\"*\" to-ports=\"*\" secure=\"false\" /><site-control permitted-cross-domain-policies=\"master-only\" /></cross-domain-policy>";
                                                                 socket_write($client[$i]['sock'],$cdmp.chr(0));
                                                                 socket_close($client[$i]['sock']);
                                                                 unset($client[$i]);
                                                                 $cdmp="";
                                                    }
                                       }
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