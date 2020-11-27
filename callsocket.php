<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<script>
$(document).ready(function(){

    // $.ajax({url:'/backend/websocket.php', success:function(result)
    // {
    //     console.log(result);
    // }});
        const port = 8000;
    // $.post('/backend/websocket.php',{cheese:port},
    // function(data, status){

    //     console.log(data);
    // });

    var websocket = new WebSocket(`ws://192.168.50.50:${port}/websocket.php`);

        websocket.onopen = function(event){
            console.log('You have been connected!');

            websocket.send('This is awesome!');
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

    
});
</script>
</body>
</html>