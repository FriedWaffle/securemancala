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
            "WebSocket-Location: ws://$host_name:$port\r\n".
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
            $this->headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
            socket_write($this->client, $this->headers, strlen($this->headers));
        }
    }
?>