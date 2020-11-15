<?php

    session_start();
    
    if(!isset($_SESSION['icecream']))
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="/scripts/chat.js"></script>
    </head>
    <body onload="loaded();">
    <script>

        var lab;

        function loaded(){

            document.body.innerHTML = `<div class="theForm chat">
                <div class="message">
                <div class="word" id="msg">
                
                </div>
                </div>
                <div class="aim">
                <input type="text" maxlength="250" id="messages" name="message" placeholder="Enter your message here...">
                <button onclick="send(\'<?php echo $_SESSION['jumpkey']; ?>\');">Send</button>
                </div>
            </div>`;
            
            
            
            document.addEventListener("keyup",function(event){
                if(event.keyCode === 13)
                {
                    send('<?php echo $_SESSION['jumpkey']?>');
                }
            });

            // window.addEventListener('beforeunload',function(e){

            // $.post(
            //     '/backend/gameplays.php',
            //     {jumpJack:'<?php echo $_SESSION['jumpkey']; ?>',op:'delete'},
            //     function(data, status){
            //         console.log(data);
            //     });
            // });

            $.post('/backend/chats.php',{jumpjack:'<?php echo $_SESSION['jumpkey']; ?>', 
                op:'create'}, 
            function(data, status)
            {
                console.log(data);
                lab = data;
                // lab = JSON.parse(data);
                // console.log(lab);

            });


            setInterval(function()
            {
                if(lab != null)
                {
                        $.post('/backend/chats.php',{luckyNum:lab,op:'read'},function(data, status){
                            
                            var json = JSON.parse(data);

                            console.log(data);
                            // var msgs;
                            
                            // var div = document.createElement('div');
                            // var p = document.createElement('p');
                            // var b = document.createElement('br');

                            $div = $('<div></div>');
                            for(var k in json)
                            {
                                $div.append('<p><span>'+json[k].player+'</span>: '+json[k].msg+'</p>');
                            }
                           
                            document.getElementById('msg').innerHTML = $div.html();

                        });
                }
            }, 1000);
        }

        
    </script>
    <?php 
    
    echo '';
    
    ?>
    
    </body>
</html>