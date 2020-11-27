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
    <body>
    <script>

        var lab;
        var status = [];
        status[0] = "create";
        status[1] = "join";

        function loaded(){

            // document.body.innerHTML = `<div class="theForm chat">
            //     <div class="message">
            //     <div class="word" id="msg">
                
            //     </div>
            //     </div>
            //     <div class="aim">
            //     <input type="text" maxlength="250" id="messages" name="message" placeholder="Enter your message here...">
            //     <button onclick="send(\'<?php echo $_SESSION['jumpkey']; ?>\');">Send</button>
            //     </div>
            // </div>`;

            

            // window.addEventListener('beforeunload',function(e){

                $.post('/backend/chats.php',{jumpjack:'<?php echo $_SESSION['jumpkey']; ?>', 
                op:'create'}, 
                function(data, status)
                {
                    console.log(data);
                    lab = data;

                });
            // $.post(
            //     '/backend/gameplays.php',
            //     {jumpJack:'<?php $_SESSION['jumpkey']; ?>',op:'delete'},
            //     function(data, status){
            //         console.log(data);
            //     });
            // });

            // if("<?php $_SESSION['op'] ?>" == "create")
            // {
            //     console.log('I have made!');
                
            // }
            // else if("<?php $_SESSION['op'] ?>" == "join")
            // {
            //     console.log("I have arrive!");
            //     $.post('/backend/chats.php',{jumpjack:'<?php echo $_SESSION['jumpkey']; ?>', op:'find'}, function(data,status){
            //         console.log(data);
            //         lab = data;
            //     });
            // }


            // setInterval(function()
            // {
            //     if(lab != null)
            //     {
            //             $.post('/backend/chats.php',{luckyNum:lab,op:'read'},function(data, status){
                            
            //                 var json = JSON.parse(data);

            //                 console.log(data);
                            
            //                 $div = $('<div></div>');
            //                 for(var k in json)
            //                 {
            //                     $div.append('<p><span>'+json[k].player+'</span>: '+json[k].msg+'</p>');
            //                 }
                           
            //                 document.getElementById('msg').innerHTML = $div.html();

            //             });
            //     }
            // }, 1000);
        }

        function showMessage(messageHTML)
        {
            $('#msg').append(messageHTML);
        }

        $(document).ready(function()
        {

            document.body.innerHTML = `<div class="theForm chat">
                <div class="message">
                <div class="word" id="msg">
                
                </div>
                </div>
                <div class="aim">
                <input type="text" maxlength="250" id="messages" name="message" placeholder="Enter your message here...">
                <button id="bthChat">Send</button>
                </div>
            </div>`;
            
            
            
            document.addEventListener("keyup",function(event){
                if(event.keyCode === 13)
                {
                    send('<?php echo $_SESSION['jumpkey']?>');
                }
            });

		var websocket = new WebSocket("ws://192.168.50.50:98/php-socket.php"); 
		websocket.onopen = function(event) { 
			showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		
		}
		websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
			showMessage("<div>"+Data.message+"</div>");
			$('#messages').val('');
		};
		
		websocket.onerror = function(event){
			showMessage("<div class='error'>Problem due to some Error</div>");
		};
		websocket.onclose = function(event){
			showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
		}; 
		
		$('#btnChat').on("click",function(event){
			event.preventDefault();
			$('#chat-user').attr("type","hidden");		
			var messageJSON = {
				chat_user: '<?php echo $_SESSION['jumpkey']; ?>',
				chat_message: $('#messages').val()
			};
			websocket.send(JSON.stringify(messageJSON));
		});
        });
        
    </script>
    <?php 
    
    echo '';
    
    ?>
    
    </body>
</html>