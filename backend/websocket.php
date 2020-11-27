<?php

    include_once "../classes/Socket.class.php";

        echo "Yikes";
        $socket = new Socket(8000);

        


        while(true)
        {
            sleep(2);
            $serverSocketArray = $socket->client;
            socket_select($serverSocketArray, $null, $null, 0, 10);

            if(in_array($socket->server, $serverSocketArray))
            {
                $newSocket = socket_accept($socket->server);
                $clientSocketArray[] = $newSocket;

                $request = socket_read($this->client, 5000);

                $socket->handshakes($request, $newSocket, "192.168.50.50", 8000);


                $newSocketIndex = array_search($socket->server, $serverSocketArray);
                unset($serverSocketArray[$newSocketIndex]);

            }

            foreach($serverSocketArray as $newSocketArrayResource)
            {
                while(socket_recv($newSocketArrayResource, $socketData, 5000, 0) >=1){
                    $socketMsg = $socketData;

                    $messageObj = json_decode($socketMsg);

                    $displayMsg = $socket->sendMessage($_POST['jumpjack'], $messageObj->msg);

                    break 2;
                    
                }
            }

            $socketData = @socket_read($newSocketArrayResource, 1024, PHP_NORMAL_READ);
            if($socketData == false)
            {
                echo "Skip";
            }

            // $content= "Thanks!";
            // $response = chr(129) . chr(strlen($content)) . $content;
                
            // socket_write($socket->client, $response);
        }
?>
