<?php
    $_GET['cheese'] = "342rfdfasfd";
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<button id='send'>Send</button>
<script>
$(document).ready(function(){

        const port = 98;
    var websocket = new WebSocket(`ws://192.168.50.50:${port}/websocket.php`);

        websocket.onopen = function(event){
            console.log('You have been connected!');

            
        }

        websocket.onerror = function(event){
            console.log(event);
        }

        websocket.onclose = function(event){
            console.log('You have been disconnected');
        }

        websocket.onmessage = function(event){
            console.log(event.data);
        }

        $('#send').on('click',function(){
            var json = {
                username: 'Joel',
                message: 'This is awesome!'
            };
            websocket.send(JSON.stringify(json));
        })

    
});
</script>
</body>
</html>