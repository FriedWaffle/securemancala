var lab;
var status = [];
status[0] = "create";
status[1] = "join";

function aim(play){

    document.body.innerHTML = `<div class="wrap">
    <div class="word" id="msg">
    </div>
    <div class="aim">
         <input type="text" maxlength="250" id="messages" name="message" placeholder="Enter your message here...">
         <button class="btnSend" onclick="send(\'<?php echo $_SESSION['jumpkey']; ?>\');">Send</button>
    </div>
    </div>`;
    
    
    
    document.addEventListener("keyup",function(event){
        if(event.keyCode === 13)
        {
            send(play);
        }
    });

        $.post('/backend/chats.php',{jumpjack:play, 
        op:'create'}, 
        function(data, status)
        {
            console.log(data);
            lab = data;

        });

    var i = 1;

    //to delay the chat to avoid piling up the request's queue or breaking it rhytem
    const delayChat = deplayMs => new Promise((resolve) =>{
        setTimeout(resolve, deplayMs);
    });

    //set to frequenting request the chat server to retreive all chat data. 
    setInterval(async () =>
    {
        if(lab != null)
        {
                $.post('/backend/chats.php',{luckyNum:lab,op:'read'},function(data, status){
                    
                    var json = JSON.parse(data);

                    console.log(data);
                    
                        $div = $('<div></div>');
                        
                        for(var k in json)
                        {
                            if( play == json[k].player)
                            {
                                $div.append('<div class="container"><a>'+json[k].player+'</a><p>'+json[k].msg+'</p></div>');
                            }
                            else
                            {
                                $div.append('<div class="container darker"><a>'+json[k].player+'</a><p>'+json[k].msg+'</p></div>');
                            }
                            
                        }

                        document.getElementById('msg').innerHTML = $div.html();


                });
        }

     await delayChat(1000);
    }, 1000);
}