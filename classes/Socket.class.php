<?php
    class Socket
    {
        public $server;
        public $client;
        public $headers;
        public $request;


        function __construct($port)
        {
            $this->server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_set_option($this->server, SOL_SOCKET, SO_REUSEADDR, 1);
            socket_bind($this->server, "192.168.50.50", $port);
            socket_listen($this->server);

            $this->client = array($this->server);            
        }

        function handshakes($request, $newSocket, $host, $port)
        {
            $headersArr = array();
            $lines = preg_split("/\r\n/", $request);
            foreach($lines as $line)
            {
                $line = chop($line);
                if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
                {
                    $headersArr[$matches[1]] = $matches[2];
                }
            }

            $secKey = $headers['Sec-WebSocket-Key'];
            $secAccept = base64_encode(pack('H*', sha1($secKey.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
            $buffer  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "WebSocket-Origin: $host_name\r\n" .
            "WebSocket-Location: ws://$host:$port/demo/shout.php\r\n".
            "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
            socket_write($newSocket,$buffer,strlen($buffer));
        }

        function sendMessage($user, $message)
        {
            $display = $user .": <div><p>".$message . "</p></div>";
            $displayArr = array('display'=>$display);
            $displayMsg = json_encode($displayArr);

            $msgLength = strlen($message);
            foreach($this->client as $clientSock)
            {
                @socket_write($clientSock, $message, $msgLength);
            }
            return true;
        }

        function unseal($socketData){
            $length = ord($socketData[1]) & 127;
            if($length == 126){
                $masks = substr($socketData, 10, 4);
                $data = substr($socketData, 8);
            }
            elseif($length == 127){
                $masks = substr($socketData, 10, 4);
                $data = substr($socketData, 14);
            }
            else{
                $masks = substr($socketData, 2, 4);
                $data = substr($socketData, 6);
            }
            $socketData = "";
            for($i = 0; $i < strlen($data); ++$i){
                $socketData .= $data[$i] ^ $masks[$i%4];
            }

            return $socketData;
        }

        function seal($socketData){
            $b1 = 0x80 | (0x1 & 0x0f);
            $length = strlen($socketData);

            if($length <= 125)
			$header = pack('CC', $b1, $length);
            elseif($length > 125 && $length < 65536)
                $header = pack('CCn', $b1, 126, $length);
            elseif($length >= 65536)
                $header = pack('CCNN', $b1, 127, $length);
            return $header.$socketData;
        }

        function handshake()
        {
            preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $request, $matches);
            $key = base64_encode(pack(
                'H*',
                sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
            ));
            $this->headers = "HTTP/1.1 101 Switching Protocols\r\n";
            $this->headers .= "Upgrade: websocket\r\n";
            $this->headers .= "Connection: Upgrade\r\n";
            $this->headers .= "Sec-WebSocket-Version: 13\r\n";
            $this->headers .= "WebSocket-Location: ws://$host_name:$port/demo/shout.php\r\n";
            $this->headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
            socket_write($this->client, $this->headers, strlen($this->headers));
        }
    }
?>