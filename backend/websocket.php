<?php

    include_once "../classes/Socket.class.php";

        echo "Yikes";
        $socket = new Socket(8000);

        


        while(true)
        {
            $serverSocketArray = $socket->client;
            socket_select($newSocketArray, $null, $null, 0, 10);

            if(in_array($socket->server, $newSocketArray))
            {
                $newSocket = socket_accept($socket->server);
                $clientSocketArray[] = $newSocket;

                $request = socket_read($this->client, 5000);

                $socket->handshakes($request, $newSocket, "192.168.50.50", 8000);

                socket_getpeername($newSocket, "192.168.50.50");

                $newSocketIndex = array_search($socket->server, $newSocketArray);
                unset($newSocketArray[$newSocketIndex]);

            }

            foreach($newSocketArray as $newSocketArrayResource)
            {
                while(socket_recv($newSocketArrayResource, $socketData, 5000, 0) >=1){
                    $socketMsg = $socketData;

                    $messageObj = json_decode($socketMsg);

                    $displayMsg = $socket->sendMessage($_POST['jumpjack'], $messageObj->msg);

                    break 2;
                    
                }
            }
            $content= "Thanks!";
            $response = chr(129) . chr(strlen($content)) . $content;
                
            socket_write($socket->client, $response);

            // if(in_array($socketResource, $newSocketArray)){
            //     $newSocket = socket_accept($socketResource);
            //     $incomingSocketArray[] = $newSocket;
                
            // }
        }
?>
